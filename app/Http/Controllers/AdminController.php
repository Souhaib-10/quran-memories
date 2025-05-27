<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show list of admins
    public function index()
    {
        $admins = User::where('role', 'admin')->get();  // Get all admin users
        return view('admin.index', compact('admins'));
    }

    // Show form to create new admin
    public function create()
    {
        return view('admin.create');
    }

    // Store new admin
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin created successfully!');
    }

    // Show form to edit an admin
    public function edit(User $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    // Update an admin
    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $admin->password,
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin updated successfully!');
    }

    // Delete an admin
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully!');
    }
}
