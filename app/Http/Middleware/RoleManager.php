<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Constants\UserRole;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
      //

      //
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Only apply to users from 'web' guard (students & institutes)
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $authUser = Auth::user();

        if (!isset($authUser->role)) {
            return redirect()->route('login'); // Defensive check
        }

        $authUserRole = $authUser->role;

        switch ($role) {
            case 'institute':
                if ($authUserRole == UserRole::InstituteRole) {
                    return $next($request);
                }
                break;

            case 'user':
                if ($authUserRole == UserRole::UserRole) {
                    return $next($request);
                }
                break;
        }

        // Redirect mismatched users to their actual home
        switch ($authUserRole) {
            case UserRole::InstituteRole:
                return redirect()->route('institute_profile');
            case UserRole::UserRole:
                return redirect()->route('user_home');
            default:
                return redirect('/'); // fallback
        }
    }
}

