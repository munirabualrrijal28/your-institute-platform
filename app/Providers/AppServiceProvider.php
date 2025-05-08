<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Constants\UserRole;

use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */

    public static function  home_route() {

        // return Auth::user()->role == 1 ? route('institute.welcome') : route('user.welcome');
//
        // return Auth::user()->role == 1 ? route('redirectToHome') : route('redirectToHome');
    //    return  route('home');
//     switch(Auth::user()->role){
//         case UserRole::AdminRole:
//             return route('admin');
//         case UserRole::InstituteRole:
//             // return redirect()->route('institute');
//             return  route('institute_home');
//         case UserRole::UserRole:
//             // return redirect()->route('user');
//             return  route('user_home');

//             default:
//         return  route('/'); // Fallback to login
//    }

    }


    public function register(): void
    {

        //

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        //
            // Force redirect from root to role-based dashboard if authenticated

    if (Request::is('/') && Auth::check()) {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            redirect()->route('admin')->send(); // force redirect and stop execution
        } elseif ($role === 'institute') {
            redirect()->route('institute_home')->send();
        } elseif ($role === 'user') {
            redirect()->route('user_home')->send();
        }
    }

    Paginator::useTailwind();

    }



}
