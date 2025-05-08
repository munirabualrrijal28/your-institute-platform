<?php

namespace App\Http\Controllers\Auth;

use App\Constants\UserRole;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Institute;
use App\Providers\AppServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        // dd($request->role);

        // Convert string role to numeric before validation
        $request->merge([
            'role' => match ($request->role) {
                'institute' => UserRole::InstituteRole,
                'student' => UserRole::UserRole,
            },
        ]);


        // down line code dd function for printing something in the screen and everything will stop there no line after it will run
        // dd($request->role);
        // Validate shared fields
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'numeric'],
        ]);

        $user_id = Auth::id();
        // $user_name = Auth::name();

        // Handle role-specific validation
        switch ($request->role) {
            case UserRole::InstituteRole:
                $request->validate([
                    'ins_name' => ['required', 'string', 'max:255'],
                    'ins_profile_photo' => ['nullable', 'image', 'max:2048'],
                    'ins_lic_photo' => ['nullable', 'image', 'max:2048'],
                ]);

                // Create course-specific directory if not exists

                $folderPath = "ins_profile/{$request->ins_name}/{$user_id}";
                if (!Storage::disk('public')->exists($folderPath)) {
                    Storage::disk('public')->makeDirectory($folderPath);
                }

                // Handle course photo (image)
                if ($request->hasFile('ins_profile_photo')) {
                    $photo = $request->file('ins_profile_photo');
                    $profile_photo = Str::random(20) . '.' . $photo->getClientOriginalExtension();
                    $photo->storeAs($folderPath, $profile_photo, 'public');
                }
                if ($request->hasFile('ins_lic_photo')) {
                    $photo = $request->file('ins_lic_photo');
                    $lic_photo = Str::random(20) . '.' . $photo->getClientOriginalExtension();
                    $photo->storeAs($folderPath, $lic_photo, 'public');

                }





                break;

            case UserRole::UserRole:
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                ]);
                break;
        }

        //
        //



        $user = User::create([
            'name' => $request->role === UserRole::InstituteRole ? $request->ins_name : $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role === UserRole::InstituteRole ? UserRole::InstituteRole : UserRole::UserRole,
        ]);

        // Create related profile based on role
        switch ($request->role) {
            case UserRole::UserRole:
                Student::create([
                    'user_id_fk' => $user->id,
                ]);
                break;

            case UserRole::InstituteRole:



                Institute::create([
                    'user_id_fk' => $user->id,
                    'ins_name' => $user->name,
                    'ins_profile_photo' => "storage/{$folderPath}/{$profile_photo}" ?? '',
                    'ins_lic_photo' => "storage/{$folderPath}/{$lic_photo}" ?? '',
                    'ins_is_verified' => false, // Default to false

                    // 'description' can be updated later
                ]);





                break;
        }

        // Fire registration event and log in the user
        event(new Registered($user));
        Auth::login($user);

        $authUserRole = Auth::user()->role;

        // if ($authUserRole == UserRole::AdminRole) {
        //     return redirect()->route('admin');
        // } elseif ($authUserRole == UserRole::InstituteRole) {
        //     return redirect()->route('institute_home');
        // } else {
        //     return redirect()->route('user_home');
        // }
        switch ($authUserRole) {
            case UserRole::AdminRole:
                return redirect()->route('admin');
            case UserRole::InstituteRole:
                // return redirect()->route('institute');

                return redirect()->route('institute_profile');
            case UserRole::UserRole:
                // return redirect()->route('user');
                return redirect()->route('user_home');

            default:
                return route('/'); // Fallback to login
        }

        // return redirect(AppServiceProvider::home_route());
        // return redirect(route('welcome', absolute: false));

    }

}


// <!--

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rules;
// use Illuminate\View\View;

// class RegisteredUserController extends Controller
// {
//     /**
//      * Display the registration view.
//      */
//     public function create(): View
//     {
//         return view('auth.register');
//     }

//     /**
//      * Handle an incoming registration request.
//      *
//      * @throws \Illuminate\Validation\ValidationException
//      */
//     public function store(Request $request): RedirectResponse
//     {
//         $request->validate([
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         ]);

//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//         ]);

//         event(new Registered($user));

//         Auth::login($user);

//         return redirect(route('dashboard', absolute: false));
//     }
// }
// -->


