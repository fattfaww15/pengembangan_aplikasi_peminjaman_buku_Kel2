<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Author;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            // Admin dashboard - global statistics
            $stats = [
                'total_books' => \App\Models\Book::sum('stock'),
                'total_authors' => \App\Models\Author::count(),
                'total_users' => \App\Models\User::count(),
                'active_transactions' => \App\Models\Transaction::where('status', 'borrowed')->count(),
                'pending_transactions' => \App\Models\Transaction::where('status', 'pending')->count(),
                'overdue_transactions' => \App\Models\Transaction::where('status', 'borrowed')
                    ->where('due_at', '<', now())
                    ->count(),
            ];

            $recent_transactions = \App\Models\Transaction::with(['user', 'book.author'])
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard', compact('stats', 'recent_transactions'));
        } else {
            // User dashboard - personal statistics
            $user = auth()->user();

            $stats = [
                'borrowed_books' => $user->transactions()->where('status', 'borrowed')->count(),
                'returned_books' => $user->transactions()->where('status', 'returned')->count(),
                'pending_books' => $user->transactions()->where('status', 'pending')->count(),
                'overdue_books' => $user->transactions()
                    ->where('status', 'borrowed')
                    ->where('due_at', '<', now())
                    ->count(),
            ];

            $my_transactions = $user->transactions()
                ->with('book.author')
                ->latest()
                ->take(10)
                ->get();

            $upcoming_dues = $user->transactions()
                ->with('book.author')
                ->where('status', 'borrowed')
                ->where('due_at', '>', now())
                ->where('due_at', '<=', now()->addDays(7))
                ->orderBy('due_at')
                ->get();

            return view('dashboard', compact('stats', 'my_transactions', 'upcoming_dues'));
        }
    }
}