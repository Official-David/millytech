<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Trade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::latest()->get();
        $trades = Trade::latest()->get();
        return view('admin.index',compact('users','trades'));
    }
}
