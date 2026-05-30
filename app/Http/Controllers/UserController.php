<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function AddImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp',
        ]);
        $user = auth()->user();
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp'
        ]);
        $image_path = $request->file('image')->store('imageProfile', 'public');
        $user->update([
            'image' => $image_path,
        ]);
        return redirect()
            ->back()
            ->with('success', 'image Updated Successfuly !');
    }
}
