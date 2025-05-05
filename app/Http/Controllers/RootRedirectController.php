<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Constants\UserRole; // If you use an enum


class RootRedirectController extends Controller
{
    public function __invoke(Request $request)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            // If you use enum
            switch ($role) {
                case UserRole::AdminRole:
                    return redirect()->route('admin');

                case UserRole::InstituteRole:
                    return redirect()->route('institute_profile');

                case UserRole::UserRole:
                    return redirect()->route('user_home');
            }

            // Optional fallback
            return abort(403, 'Unauthorized role.');
        }

        // Guest view
        return view('home');
    }
}
