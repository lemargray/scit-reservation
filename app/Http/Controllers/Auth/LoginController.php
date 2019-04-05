<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        return 'username';
    }

    public function redirectPath()
    {
        return $this->redirectTo;
    }

    protected function credentials(Request $request)
    {
        return array_merge(
            $request->only($this->username(), 'password'),
            ['active' => 1]
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [
            $this->username() => [trans('auth.failed')],
        ];

        $user = \App\User::where('username', request()->input('username'))->first();


        if($user && $user->active == 0){
            $errors['username'] = "Account is locked. Please contact a Lab Tech.";
        }

        throw ValidationException::withMessages($errors);
    }
}
