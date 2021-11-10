<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;

class SettingsController extends Controller
{
    use PasswordValidationRules;

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

    public function password()
    {
        return view('user.settings.password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => $this->passwordRules(),
        ]);
        $user = User::findOrFail(auth(config('fortify.guard'))->user()->id);
        // dd(Hash::check($request->current_password,$user->password));

        if(!Hash::check($request->current_password,$user->password))
        {
            return back()->withErrors(['current_password' => 'Your current password is incorrect'])->withInput();
        }

        if(Hash::check($request->password,$user->password))
        {
            return back()->withErrors(['password' => 'Old password detected'])->withInput();
        }

        $user->password = $request->password;
        $user->save();
        session()->flash('message','Password updated successfully');
        return back();
    }

    public function profile()
    {
        return view('user.settings.profile');
    }

    public function updateProfile(Request $request)
    {

    }
}
