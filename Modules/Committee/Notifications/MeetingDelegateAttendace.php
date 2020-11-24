<?php

namespace Modules\Committee\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Channels\MobilyChannel;

class MeetingDelegateAttendace extends Notification implements ShouldQueue
{
    use Queueable;
    private $committee;
    private $department;
    private $meeting;

    /**
     * Create a new notification instance.
     *
     * @param $committee
     * @param $meeting
     * @param $department
     */
    public function __construct($committee, $meeting, $department)
    {
        $this->committee = $committee;
        $this->department = $department;
        $this->meeting = $meeting;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', MobilyChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('committee::notifications.delegate_approve_attendace') . ' ' . $this->committee->subject)
            ->markdown('committee::emails.meeting_delegate_attendace', ['committee' => $this->committee, 'meeting' => $this->meeting, 'department' => $this->department]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'committee' => $this->committee,
            'notified_user' => $notifiable
        ];
    }
    public function toMobily($notifiable)
    {
        return [
            'message' => __('committee::notifications.delegate_approve_attendace_message',
                ['number' => $this->committee->resource_staff_number, 'department'=> $this->department])
                . ' ' . route('committee.meetings.show', ['committee' => $this->committee, 'meeting' => $this->meeting])
        ];
    }
}
