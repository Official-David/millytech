<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Http\Responses\LogoutResponse;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as Controller;

class AuthenticatedSessionController extends Controller
{
    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        if(!auth('user')->check() && !auth('admin')->check()){
            $request->session()->invalidate();

            $request->session()->regenerateToken();
        }

        return app(LogoutResponse::class);
    }
}
