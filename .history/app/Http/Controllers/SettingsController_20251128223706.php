<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    public function general()
    {
        return view('settings.general');
    }

    public function notifications()
    {
        return view('settings.notifications');
    }

    public function security()
    {
        return view('settings.security');
    }

    public function appearance()
    {
        return view('settings.appearance');
    }
}