<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Notification extends Component
{
    public $notifications, $notification_count;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $user?->load('notifications');

        $notification_count = DB::table('notification_user')
            ->where('user_id', $user->id)
            ->where('read', 0)->count();

        $this->notification_count = $notification_count > 9
            ? '9+'
            : $notification_count;

        $this->notifications = $user->notifications()->latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification');
    }
}
