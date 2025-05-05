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
     public function handle(Request $request, Closure $next , $role): Response
    {
        // $AdminRole = 0;
        // $InstituteRole = 1;
        // $UserRole = 2;

       if(!Auth::check()){
        return redirect()->route('login');
       }
       $authUserRole = Auth::user()->role;


switch ($role) {
    case 'admin':
        if ($authUserRole == UserRole::AdminRole) {
            return $next($request); // ✅ ALLOW access
        }
        break;

    case 'institute':
        if ($authUserRole == UserRole::InstituteRole) {
            return $next($request); // ✅ ALLOW access
        }
        break;

    case 'user':
        if ($authUserRole == UserRole::UserRole) {
            return $next($request); // ✅ ALLOW access
        }
        break;
}

//
//    // Only intercept the root URL
//    if ($request->is('/')) {

//     if (Auth::check()) {
//         $role = Auth::user()->role;

//         if ($role === UserRole::AdminRole) {
//             return redirect()->route('admin');
//         } elseif ($role === UserRole::InstituteRole) {
//             return redirect()->route('institute_home');
//         } elseif ($role === UserRole::UserRole) {
//             return redirect()->route('user_home');
//         }
//     }
// }

       switch($authUserRole){
            case UserRole::AdminRole:
                return redirect()->route('admin');
            case UserRole::InstituteRole:
                // return redirect()->route('institute');
                return redirect()->route('institute_home');
            case UserRole::UserRole:
                // return redirect()->route('user');
                return redirect()->route('user_home');

                default:
            return redirect()->route('/'); // Fallback to login
       }


    //    return redirect()->route('login');

    }
}
