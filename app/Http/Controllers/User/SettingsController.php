<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function bankDetails()
    {
        $user = auth(config('fortify.guard'))->user();
        return view('user.settings.bank',compact('user'));
    }

    public function bankDetailsUpdate(Request $request)
    {
        $request->validate([
            'account_name' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|numeric',
        ]);

        $user = User::findOrFail(auth(config('fortify.guard'))->user()->id);
        $user->bank()->update($request->except('_token'));
        return back();
    }
}
