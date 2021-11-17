<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trade;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = User::find(auth(config('fortify.guard'))->user()->id);
        $user->load('trades');
        return view('user.index',compact('user'));
    }
}
