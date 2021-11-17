<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd('here');
        $status = auth('user')->user()->status;
        if(! in_array(url()->current(),[route('user.settings.profile'),route('user.settings.profile.update')])){
            if($status == 'pending'){
                return redirect()->route('user.settings.profile');
            }elseif($status == 'inactive'){
                auth('user')->logout();
                return redirect()->route('login')->withErrors(['email'=>'Your account is inactive, please contact support']);
            }
        }
        return $next($request);
    }
}
