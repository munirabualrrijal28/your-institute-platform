<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Constants\UserRole; // If you use an enum
use App\Models\Institute;

class RootRedirectController extends Controller
{
    public function __invoke(Request $request)
    {

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::check()) {
            $role = Auth::user()->role;

            // If you use enum
            switch ($role) {

                case UserRole::InstituteRole:
                    return redirect()->route('institute_profile');

                case UserRole::UserRole:
                    return redirect()->route('user_home');
            }

            // Optional fallback
            return abort(403, 'Unauthorized role.');
        }

        // Guest view


        $institutes = Institute::all();

        return view('layouts.app', compact('institutes'));
    }
}
