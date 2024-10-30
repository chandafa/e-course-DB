<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Mengambil semua user
    public function index()
    {
        $users = User::all();
        return response()->json(['status' => 200, 'message' => 'success', 'data' => $users]);
    }

    // Menambahkan user baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
        ]);

        return response()->json(['status' => 200, 'message' => 'User created successfully', 'data' => $user]);
    }

    // Menampilkan detail user berdasarkan ID
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => 404, 'message' => 'User not found']);
        }

        return response()->json(['status' => 200, 'message' => 'success', 'data' => $user]);
    }

    // Update user
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => 404, 'message' => 'User not found']);
        }

        // Update data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return response()->json(['status' => 200, 'message' => 'User updated successfully', 'data' => $user]);
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => 404, 'message' => 'User not found']);
        }

        $user->delete();

        return response()->json(['status' => 200, 'message' => 'User deleted successfully']);
    }
}