<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function show(){
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit(){
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request){
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('profile_picture')){
            if($user->profile_picture){
                Storage::delete('public/profile-pictures/' . $user->profile_picture);
            }
            $fileName = time().'.'.$request->profile_picture->extension();
            $request->profile_picture->storeAs('public/profile-pictures', $fileName);
            $validated['profile_picture'] = $fileName;
        }

        $user->update($validated);

        return redirect()->route('profile.show')->with('success','Profile updated successfully!');
    }

    public function updatePassword(Request $request){
        $user = Auth::user();
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required','confirmed', Rules\Password::defaults()]
        ]);

        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('profile.show')->with('success','Password updated successfully!');
    }
}
