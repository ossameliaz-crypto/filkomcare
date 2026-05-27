<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,'.$user->id,
            'phone_number' => 'nullable|string|max:20',
            'nim' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function privacy()
    {
        return view('profile.privacy');
    }

    public function notifications()
    {
        return view('profile.notifications');
    }

    public function faq()
    {
        return view('profile.faq');
    }

    public function settings()
    {
        return view('profile.settings');
    }
}
