<?php

namespace Modules\Committee\Notifications;

use App\Channels\MobilyChannel;
use App\Classes\Date\CarbonHijri;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommitteeRemembered extends Notification implements ShouldQueue
{
    use Queueable;

    private $committee;
    private $meeting;

    /**
     * Create a new notification instance.
     *
     * @return void
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
            ->subject(__('committee::notifications.urgent_committee_users_remembered'))
            ->markdown('committee::emails.committee_remembered', ['committee' => $this->committee, 'meeting' => $this->meeting, 'day' => CarbonHijri::toHijriFromMiladi($this->meeting->meeting_at, 'l')]);
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
            'message' =>__('committee::notifications.urgent_committee_notification',
                    ['number' => $this->committee->resource_staff_number, 'date' => $this->meeting->meeting_at, 'hall'=> $this->meeting->room->name, 'day' => CarbonHijri::toHijriFromMiladi($this->meeting->from, 'l')])
                . ' ' . route('committee.meetings.show', [$this->committee, $this->meeting])
        ];
    }
}
