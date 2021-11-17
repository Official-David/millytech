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

        if(!$user->bank){
            $user->bank()->create($request->except('_token'));
            session()->flash('message','Bank details added successfully');
        } else{
            session()->flash('message','Bank details updated successfully');
            $user->bank()->update($request->except('_token'));
        }

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
        $user = User::findOrFail(auth(config('fortify.guard'))->user()->id);

        return view('user.settings.profile',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|regex:/^[+][0-9]{9,14}/',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'zip_code' => 'required',
            'gender' => 'required',
            'avatar' => 'nullable|mimes:jpg,png,jpeg'
        ],[
            'phone.regex' => 'phone must be internatonal format'
        ]);

        $user = User::findOrFail(auth(config('fortify.guard'))->user()->id);
        $data = $request->except(['_token','avatar']);
        if($request->hasFile('avatar'))
        {
            $dir = public_path(config('dir.profile'));
            if($user->avatar && is_file($dir.$user->avatar)) unlink($dir.$user->avatar);

            $filename = str_replace(' ','-',$dir.now()->toDateTimeString().'.'.$request->file('avatar')->extension());
            file_put_contents($filename,$request->file('avatar')->get());
            $data['avatar'] = basename($filename);
        }
        if($user->status == 'pending')
        {
            $data['status'] = 'active';
        }
        $user->update($data);
        session()->flash('message','Profile updated');
        return back();

    }
}
