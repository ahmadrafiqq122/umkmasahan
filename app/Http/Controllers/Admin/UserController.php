<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::withCount('businesses');

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->filled('status')) {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show user details
     */
    public function show($id)
    {
        $user = User::withCount(['businesses', 'approvedBusinesses'])
            ->with(['businesses' => function($query) {
                $query->latest()->limit(10);
            }])
            ->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a new user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'phone' => 'required|string|max:20',
            'nik' => 'nullable|string|size:16',
            'address' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'nik' => $request->nik,
            'address' => $request->address,
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        return redirect()->route('admin.users.show', $user->id)
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'phone' => 'required|string|max:20',
            'nik' => 'nullable|string|size:16',
            'address' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->except(['password', 'password_confirmation']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.show', $user->id)
            ->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Toggle user active status
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deactivating own account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return back()->with('success', "User berhasil {$status}.");
    }

    /**
     * Delete user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        // Prevent deleting user with businesses
        if ($user->businesses()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus user yang memiliki data usaha.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
