<?php

namespace Modules\Committee\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Channels\MobilyChannel;

class NominationRememberNotification extends Notification implements ShouldQueue
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
            ->subject(__('committee::notifications.nomination_remember') . ' ' . $this->committee->subject)
            ->markdown('committee::emails.nomination_remembered', ['committee' => $this->committee]);
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
            'message' => __('committee::committees.committee_not_have_nomination_alert')
                . ' ' .route('committees.show', $this->committee)
        ];
    }
}
