<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function showAlertModal($id)
    {
        $user = User::findOrFail($id);
        $html = view('components.user-alert-data', ['user' => $user])->render();
        return response()->json([
            'html' => $html
        ]);
    }

    public function addAlert(Request $request, $id)
    {
        $valid = $request->validate([
            'alert_type' => ['required', 'in:scam_alert,payment_alert'],
            'alert_message' => ['required', 'string']
        ]);

        if (!User::whereId($id)->update($valid)) {
            return response()->json([
                'error_message' => 'Failed to update scam alert',
            ], 400);
        }
        return response()->json();
    }

    public function clearAlert($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'alert_type' => null,
            'alert_message' => null
        ]);
        return response()->json(['message' => 'Alert cleared from user\'s account']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        if($user->status == 'pending') return back()->with('error','Status not changed. User have not completed profile update.');

        if($user->status == 'active')
        {
            $user->status = 'inactive';
        }else{
            $user->status = 'active';
        }
        $user->save();
        return back()->with('message','User status changed');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone_number' => 'required|regex:/^[+][0-9]{9,14}/',
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
        $user = User::findOrFail($id);
        $data = $request->except(['_token','avatar']);
        if($request->hasFile('avatar'))
        {
            $dir = config('dir.profile');
            if(app()->environment() == 'local'){
                if($user->avatar && Storage::exists($dir.$user->avatar)) Storage::delete($dir.$user->avatar);
                $filename = Storage::putFile($dir,$request->file('avatar'));
            }else{
                $dir = public_path($dir);
                if($user->avatar && is_file($dir.$user->avatar)) unlink($dir.$user->avatar);
                $filename = $dir.Str::random(40).'.'.$request->file('avatar')->extension();
                file_put_contents($filename,$request->file('avatar')->get());
            }
            $data['avatar'] = basename($filename);
        }
        if($user->status == 'pending')
        {
            $data['status'] = 'active';
        }
        $user->update($data);
        session()->flash('message','User data updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->trades()->delete();
        $user->bank()->delete();
        $user->delete();
        return back()->with('message','User deleted');
    }
}
