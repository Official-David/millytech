<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use PasswordValidationRules;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::orderBy('super','desc')->paginate();
        return view('admin.settings.admin.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:admins,email',
            'super' => 'required|numeric',
            'password' => 'required|string|max:60|min:8'
        ]);

        Admin::create($request->except('_token'));
        session()->flash('message','Admin created');
        return redirect()->route('admin.settings.admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $admin = Admin::findOrFail($id);
        if($admin->id === auth(config('fortify.guard'))->user()->id) return back()->with('error','You cannot modify your super status');
        $admin->super = !$admin->super;
        $admin->save();
        session()->flash('message','Super status changed');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.settings.admin.edit',compact('admin'));
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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => "required|email|unique:admins,email,{$id}",
            'super' => 'required|numeric',
            'password' => 'nullable|string|max:60|min:8'
        ]);
        $admin = Admin::findOrFail($id);
        $data = $request->except('_token','_method','super','password');
        $admin->id != auth(config('fortify.guard'))->user()->id ? $data['super'] = $request->super : null;
        if(!is_null($admin)) $data['password'] = $request->password;
        $admin->update($data);
        return redirect()->route('admin.settings.admin.index')->with('message','Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        if($admin->id == auth(config('fortify.guard'))->user()->id) return back()-with('error','You cannot delete your admin account');
        $admin->delete();
        return back()->with('success','Admin deleted');

    }

    public function password()
    {
        return view('admin.settings.password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => $this->passwordRules(),
        ]);
        $admin = Admin::findOrFail(auth(config('fortify.guard'))->user()->id);

        if(!Hash::check($request->current_password,$admin->password))
        {
            return back()->withErrors(['current_password' => 'Your current password is incorrect'])->withInput();
        }

        if(Hash::check($request->password,$admin->password))
        {
            return back()->withErrors(['password' => 'Old password detected'])->withInput();
        }

        $admin->password = $request->password;
        $admin->save();
        session()->flash('message','Password updated successfully');
        return back();
    }
}
