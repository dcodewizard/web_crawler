<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 * php version 7.2
 *
 * @category Web_Framework
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 * @license  https://laravel.com/ MIT
 * @link     https://laravel.com/
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Class
 *
 * @category Controller
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 * @license  https://laravel.com/ MIT
 * @link     https://laravel.com/
 */


class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     *
     * @param \Illuminate\Http\Request $request comment
     * 
     * @return mixed
     */
    public function store(Request $request)
    {
        if (! Auth::guard('web')->validate(
            [
            'email' => $request->user()->email,
            'password' => $request->password,
            ]
        )
        ) {
            throw ValidationException::withMessages(
                [
                'password' => __('auth.password'),
                ]
            );
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
