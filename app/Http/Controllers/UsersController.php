<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->is_admin) {
                abort(403, 'Only admins can access user management.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'is_active' => 'boolean',
        ]);

        User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dibuat.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:users,nis,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $updateData = [
            'name' => $request->name,
            'nis' => $request->nis,
            'is_admin' => $request->has('is_admin'),
            'is_active' => $request->has('is_active'),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting admin users or self
        if ($user->is_admin || $user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Tidak dapat menghapus pengguna ini.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}