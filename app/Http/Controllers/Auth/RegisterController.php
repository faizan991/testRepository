<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        /*$data['captcha'] = $this->captchaCheck();

        if (! config('settings.reCaptchStatus')) {
            $data['captcha'] = true;
        }*/

        /*return Validator::make(
            $data,
            [
                'name'                  => 'required|max:255|unique:users|alpha_dash',
                'first_name'            => 'alpha_dash',
                'last_name'             => 'alpha_dash',
                'email'                 => 'required|email|max:255|unique:users',
                'password'              => 'required|min:6|max:30|confirmed',
                'password_confirmation' => 'required|same:password',
                'g-recaptcha-response'  => '',
                'captcha'               => 'required|min:1',
            ],
            [
                'name.unique'                   => trans('auth.userNameTaken'),
                'name.required'                 => trans('auth.userNameRequired'),
                'first_name.required'           => trans('auth.fNameRequired'),
                'last_name.required'            => trans('auth.lNameRequired'),
                'email.required'                => trans('auth.emailRequired'),
                'email.email'                   => trans('auth.emailInvalid'),
                'password.required'             => trans('auth.passwordRequired'),
                'password.min'                  => trans('auth.PasswordMin'),
                'password.max'                  => trans('auth.PasswordMax'),
                'g-recaptcha-response.required' => trans('auth.captchaRequire'),
                'captcha.min'                   => trans('auth.CaptchaWrong'),
            ]
        );*/

        return Validator::make(
            $data , 
            [
                'name' => ['required', 'string', 'max:255','unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ],[
                'name.unique'    => trans('auth.userNameTaken'),
                'name.required'  => trans('auth.userNameRequired'),
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
