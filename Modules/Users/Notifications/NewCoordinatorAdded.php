<?php

namespace Modules\Users\Notifications;

use App\Channels\MobilyChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCoordinatorAdded extends Notification implements ShouldQueue
{
    use Queueable;

    private $coordinator;

    /**
     * Create a new notification instance.
     *
     * @param $committee
     */
    public function __construct($coordinator)
    {
        $this->coordinator = $coordinator;
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
            ->subject(__('users::coordinators.coordinator_added_to_system'))
            ->markdown('users::emails.new_coordinator_added', ['coordinator'=>$this->coordinator]);
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
      /*  return [
            'message' => ''
        ];*/

        return [
            'message' => __('users::coordinators.coordinator_added_to_system')
                . ' ' . route('committees.show', $this->coordinator)
        ];
    }
}
