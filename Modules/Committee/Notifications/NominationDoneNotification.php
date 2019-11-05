<?php

namespace Modules\Committee\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Channels\MobilyChannel;

class NominationDoneNotification extends Notification implements ShouldQueue
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
            ->subject(__('committee::committees.nomination done') . ' ' . $this->committee->subject)
            ->markdown('committee::emails.nomination_done', ['committee' => $this->committee]);
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
            'message' => __('committee::committees.nomination done')
                . ' ' . $this->committee->subject
                . ' ' . route('committees.show', $this->committee)
        ];
    }
}
