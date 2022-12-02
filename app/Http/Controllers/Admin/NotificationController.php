<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    public function index()
    {
        return view('admin.notifications.index', [
            'notifications' => Notification::latest()->paginate()
        ]);
    }

    public function create()
    {
        return view('admin.notifications.create', [
            'users' => User::get(['id', 'firstname', 'lastname'])
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'message' => ['required', 'string'],
            'users.*' => ['required', 'numeric']
        ]);
        DB::beginTransaction();
        try {
            $notification = Notification::create([
                'title' => $request->input('title'),
                'message' => $request->input('message'),
            ]);
            $notification->users()->attach($request->input('users'));
            DB::commit();
            session()->flash('message', 'Notification(s) sent successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
