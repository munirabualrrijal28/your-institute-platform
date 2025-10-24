<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotificationSent;
use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Notifications;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{



    public $notifications = [];


    public function index()
    {
        $this->loadNotifications();

        return view('admin.dashboard', [
            'userCount' => User::count(),
            'studentCount' => Student::count(),
            'verifiedCount' => Institute::where('is_verified', true)->count(),
            'unverifiedCount' => Institute::where('is_verified', false)->count(),
            'notifications' => $this->notifications,
        ]);
    }


    public function settings()
    {
        $this->loadNotifications();

        return view('admin.settings', compact('notifications'));
    }
    public function manage_students()
    {
        $this->loadNotifications();

        return view('admin.institute.manage_students', compact('notifications'));
    }
    public function manage_institutes()
    {

        $this->loadNotifications();
        return view('admin.student.manage_institutes', compact('notifications'));
    }
    public function manage_notifications()
    {
        $this->loadNotifications();

        return view('admin.notification.manage_notifications', compact('notifications'));
    }

    //
    public function markNotificationAsRead($id)
    {
        $note = Notifications::find($id);

        if ($note && is_null($note->read_at)) {
            $note->update(['read_at' => now()]);
        }

        return redirect()->back(); // or route to a detail page if needed
    }





    //
    public function loadNotifications()
    {

        $admin = auth()->guard('admin')->user();
        $this->notifications = Notifications::where('reciver_id', $admin->id)
            ->where('reciver_type', \App\Models\Admin::class)
            ->latest()
            ->take(10)
            ->get();


    }

    public function markAsRead($id)
    {
        notifications::where('id', $id)->update(['read_at' => now()]);
        $this->loadNotifications();
    }


}
