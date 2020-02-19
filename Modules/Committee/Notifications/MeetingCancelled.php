<?php

namespace Modules\Committee\Notifications;

use App\Channels\MobilyChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MeetingCancelled extends Notification implements ShouldQueue
{
    use Queueable;

    private $committee;
    private $meeting;


    /**
     * Create a new notification instance.
     *
     * @param $committee
     */
    public function __construct($committee, $meeting)
    {
        $this->committee = $committee;
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
            ->subject(__('committee::notifications.meeting_cancelled') . ' ' . $this->committee->subject)
            ->markdown('committee::emails.meeting_cancelled', ['committee' => $this->committee, 'meeting' => $this->meeting]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

    }

    public function toMobily($notifiable)
    {
        return [
            'message' => __('committee::notifications.meeting_cancelled')
                . ' ' . $this->committee->subject
                . ' ' . route('committees.show', $this->committee, $this->meeting)
        ];
    }
}
