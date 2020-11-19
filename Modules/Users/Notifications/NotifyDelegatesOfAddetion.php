<?php

namespace Modules\Users\Notifications;

use App\Channels\MobilyChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyDelegatesOfAddetion extends Notification implements ShouldQueue
{
    use Queueable;

    private $committee;

    /**
     * Create a new notification instance.
     *
     * @param $committee
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
            ->subject(__('users::delegates.you added to a committee') . ' ' . $this->committee->subject)
            ->markdown('users::emails.email_notify_delegate', ['committee' => $this->committee]);
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
            'message' => __('committee::committees.committee_nomination_delegates',
                    ['number' => $this->committee->resource_staff_number])
                . ' ' . route('committees.show', $this->committee)
        ];
    }
}
