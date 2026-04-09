<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->is_admin) {
            // Admin sees all transactions
            $transactions = Transaction::with(['user', 'book.author'])->paginate(10);
        } else {
            // Regular users only see their own transactions
            $transactions = Transaction::where('user_id', $user->id)
                ->with(['user', 'book.author'])
                ->paginate(10);
        }

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $user = auth()->user();

        // Only regular users can create transactions (borrow books)
        if ($user->is_admin) {
            abort(403, 'Admins cannot create transactions directly.');
        }

        $books = Book::where('stock', '>', 0)->with('author')->get();
        return view('transactions.create', compact('books'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Only regular users can create transactions
        if ($user->is_admin) {
            abort(403, 'Admin tidak dapat membuat transaksi peminjaman secara langsung.');
        }

        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date|before_or_equal:today',
            'due_at' => 'required|date|after:today',
        ]);

        $book = Book::find($request->book_id);
        if ($book->stock <= 0) {
            return back()->withErrors(['book_id' => 'Buku sedang tidak tersedia (stok habis).']);
        }

        // Check if user already has this book borrowed (pending or borrowed status)
        $existingTransaction = Transaction::where('user_id', $user->id)
            ->where('book_id', $request->book_id)
            ->whereIn('status', ['borrowed', 'pending'])
            ->first();

        if ($existingTransaction) {
            return back()->withErrors(['book_id' => 'Anda sudah meminjam buku ini. Kembalikan terlebih dahulu sebelum meminjam lagi.']);
        }

        Transaction::create([
            'user_id' => $user->id,
            'book_id' => $request->book_id,
            'borrowed_at' => $request->borrowed_at,
            'due_at' => $request->due_at,
            'status' => 'pending', // Changed to pending for admin approval
        ]);

        return redirect()->route('transactions.index')->with('success', 'Permintaan peminjaman berhasil dikirim. Silahkan tunggu persetujuan dari admin.');
    }

    public function show(Transaction $transaction)
    {
        $user = auth()->user();

        // Users can only see their own transactions, admins can see all
        if (!$user->is_admin && $transaction->user_id !== $user->id) {
            abort(403, 'You can only view your own transactions.');
        }

        $transaction->load(['user', 'book.author']);
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $user = auth()->user();

        // Only admins can edit transaction status
        if (!$user->is_admin) {
            abort(403, 'Only admins can edit transaction status.');
        }

        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $user = auth()->user();

        if ($request->has('return_book')) {
            // Users can return their own books, admins can return any
            if (!$user->is_admin && $transaction->user_id !== $user->id) {
                abort(403, 'You can only return your own books.');
            }

            $transaction->update([
                'status' => 'returned',
                'returned_at' => now(),
            ]);

            $transaction->book->increment('stock');

            return redirect()->route('transactions.index')->with('success', 'Book returned successfully.');
        }

        // Only admins can approve/reject transactions
        if (!$user->is_admin) {
            abort(403, 'Only admins can approve or reject transactions.');
        }

        // For approving/rejecting pending transactions
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'nullable|string',
        ]);

        if ($request->status === 'approved') {
            $transaction->update(['status' => 'borrowed']);
            $transaction->book->decrement('stock');
        } elseif ($request->status === 'rejected') {
            $request->validate([
                'rejection_reason' => 'required|string',
            ]);
            $transaction->update([
                'status' => 'rejected',
                'rejection_reason' => $request->rejection_reason,
            ]);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $user = auth()->user();

        // Only regular users can delete their own pending transactions
        // Admins cannot delete transactions
        if ($user->is_admin) {
            abort(403, 'Admins cannot delete transactions.');
        }

        if ($transaction->user_id !== $user->id) {
            abort(403, 'You can only delete your own transactions.');
        }

        if ($transaction->status !== 'pending') {
            abort(403, 'You can only delete pending transactions.');
        }

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}