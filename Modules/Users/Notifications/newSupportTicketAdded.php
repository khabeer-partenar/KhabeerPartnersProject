<?php

namespace Modules\Users\Notifications;

use App\Channels\MobilyChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newSupportTicketAdded extends Notification implements ShouldQueue
{
    use Queueable;

    private $ticket;
    private $user;


    /**
     * Create a new notification instance.
     *
     * @param $committee
     */
    public function __construct($ticket,$user)
    {
        $this->ticket = $ticket;
        $this->user = $user;
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
            ->subject(__('users::support.new_support_ticket'))
            ->markdown('users::emails.new_support_ticket_added', ['ticket' => $this->ticket, 'user' => $this->user]);
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
            'coordinator' => $this->coordinator,
        ];
    }

    public function toMobily($notifiable)
    {
        
    }
}
