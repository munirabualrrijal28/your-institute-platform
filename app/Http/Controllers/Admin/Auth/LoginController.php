<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
  public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended($this->redirectTo());
        }
//         if (Auth::guard('admin')->attempt($credentials)) {
//     return redirect()->intended(route('admin.dashboard'));
// }

        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ]);
    }

    // 🔥 This is what you add:
    protected function redirectTo()
    {
        return route('admin.dashboard');
    }

}
