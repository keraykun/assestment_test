<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {

        config(['app.timezone' => 'Asia/Manila']);

        $input = $request->all();

        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);


        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            switch (Auth::user()->prefixname) {
                case 'Mr':
                    return redirect()->route('mr.users.index');
                case 'Mrs':
                    return redirect()->route('mrs.users.index');
                case 'Ms':
                    return redirect()->route('ms.users.index');
                default:
                    abort(403);
            }
        }else{
                return redirect()->route('login')
                ->with('error','Email and Password Invalid. Please try again!');
        }

    }

}
