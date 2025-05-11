<?php

namespace App\Notifications;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewFollowerNotification extends Notification
{
  use Queueable;

    public $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function via($notifiable)
    {
        return ['database']; // store in DB only
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'قام الطالب ' . $this->student->user->name . ' بمتابعتك.',
            'student_id' => $this->student->id,
            'student_name' => $this->student->user->name,
        ];
    }
}
