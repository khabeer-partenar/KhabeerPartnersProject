<?php

namespace Modules\Users\Notifications;

use App\Channels\MobilyChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DelegateCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $committee;
    private $delegate;

    /**
     * Create a new notification instance.
     *
     * @param $committee
     */
    public function __construct($delegate, $committee)
    {
        $this->committee = $committee;
        $this->delegate = $delegate;
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
            ->subject(__('users::delegates.new delegate has been created with subject') . ' ' . $this->delegate->name)
            ->markdown('users::emails.new_delegate_created', ['committee' => $this->committee,'delegate'=>$this->delegate]);
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
            'delegate' => $this->delegate,
            'notified_user' => $notifiable
        ];
    }

    public function toMobily($notifiable)
    {
        return [
            'message' => __('users::delegates.new delegate has been created with subject')
                . ' ' . $this->delegate->name
                . ' ' . route('committees.show', $this->committee)
        ];
    }
}
