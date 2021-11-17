<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return back()->with('User status changed successfully');
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
        //
    }
}
