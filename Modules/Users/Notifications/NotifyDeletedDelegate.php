<?php

namespace Modules\Users\Notifications;

use App\Channels\MobilyChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyDeletedDelegate extends Notification implements ShouldQueue
{
    use Queueable;

    private $committee;
    private $delegate;
    private $reason;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($delegate, $committee,$reason)
    {
        $this->committee = $committee;
        $this->delegate = $delegate;
        $this->reason = $reason;

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
            ->subject(__('users::delegates.delegate deleted') . ' ' . $this->delegate->name)
            ->markdown('users::emails.email_notify_deleted_delegate', ['committee' => $this->committee,'delegate'=>$this->delegate,'reason'=>$this->reason]);
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
            'reason'=>$this->reason,
            'notified_user' => $notifiable
        ];
    }

    public function toMobily($notifiable)
    {
      /*  return [
            'message' => ''
        ];*/

        return [
            'message' => __('users::delegates.delegate deleted')
                . ' ' . $this->delegate->name
                . ' '. __('users:delegates.delegate deleted for committee')
                . ' ' . $this->committee->subject
                . ' '. __('users:delegates.delegate deleted reasone')
                . ' ' . $this->reason
                . ' ' . route('committees.show', $this->committee)
        ];
    }
}
