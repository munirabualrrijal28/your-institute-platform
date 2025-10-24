<?php

namespace App\Livewire\Notifications;

use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notify extends Component
{


    public $notifications = [];
    public $unreadCount = 0;

    protected $listeners = [
        'refresh-notifications' => '$refresh'
    ];


    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $user = Auth::user();

        $this->notifications = Notifications::where('reciver_id', Auth::id())
            ->where('reciver_type', \App\Models\User::class)
            ->latest()
            ->take(10)
            ->get();

        $this->unreadCount = Notifications::where('reciver_id', Auth::id())
            ->where('reciver_type', \App\Models\User::class)
            ->whereNull('read_at')
            ->count();
    }



    public function markAllAsRead()
    {
        Notifications::where('reciver_id', Auth::id())
            ->where('reciver_type', \App\Models\User::class)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $this->loadNotifications(); // Refresh the list
    }


    public function render()
    {
        return view('livewire.notifications.notify');
    }

}
