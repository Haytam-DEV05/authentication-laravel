<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::findOrFail($request->id);
        $user->update([
            'password' => $validated['password'],
        ]);
        return redirect()
            ->back()
            ->with('success', 'User Updated Successsfuly !');
    }

    public function deleteUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'User Deleted Successfuly !');
    }

    public function show(Request $request)
    {
        $user = User::findOrFail($request->id);
        return view('admin.show', compact('user'));
    }
}
