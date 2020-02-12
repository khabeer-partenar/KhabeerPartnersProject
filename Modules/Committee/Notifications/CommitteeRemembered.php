<?php

namespace Modules\Committee\Notifications;

use App\Channels\MobilyChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommitteeRemembered extends Notification implements ShouldQueue
{
    use Queueable;

    private $committee;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($committee)
    {
        $this->committee = $committee;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject(trans('Committee::notifications.remember_urgent_committee_users'))
            ->markdown('Committee::emails.committee_remembered', ['committee' => $this->committee]);
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

    public function toMobily()
    {
        return [
            'message' =>__('committee::notifications.remember_urgent_committee_users')
                . ' ' . $this->committee->subject
        ];
    }
}
