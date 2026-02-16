<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Get list of users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Get user details
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Edit user (get user for edit form)
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->only(['name', 'username', 'email', 'mobileno', 'dob', 'status']);
        $user->update($data);
        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    // Soft delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User soft deleted successfully']);
    }

    // Set user status (active/inactive)
    public function setStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $status = $request->input('status');
        if (!in_array($status, ['active', 'inactive'])) {
            return response()->json(['error' => 'Invalid status'], 422);
        }
        $user->status = $status;
        $user->save();
        return response()->json(['message' => 'User status updated', 'status' => $user->status]);
    }

    // Add user
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'mobileno' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }
}
