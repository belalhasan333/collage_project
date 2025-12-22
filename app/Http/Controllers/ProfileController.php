<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of the users (index).
     */
    public function index(): View
    {
        $users = User::all(); // Get all users
        return view('profile.index', compact('users'));
    }

    /**
     * Show the form for creating a new user profile.
     */
    public function create(): View
    {
        return view('profile.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        User::create($data); // Create new user
        return Redirect::route('profile.index')->with('status', 'profile-created');
    }

    /**
     * Display the specified user's profile.
     */
    public function show(User $user): View
    {
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the authenticated user's profile.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the authenticated user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Remove the authenticated user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
