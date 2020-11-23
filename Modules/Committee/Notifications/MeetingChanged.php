<?php

namespace Modules\Committee\Notifications;

use App\Channels\MobilyChannel;
use App\Classes\Date\CarbonHijri;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MeetingChanged extends Notification implements ShouldQueue
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
            ->subject(__('committee::notifications.meeting_data_updated') . ' ' . $this->committee->subject)
            ->markdown('committee::emails.meeting_changed', ['committee' => $this->committee, 'meeting' => $this->meeting, 'day' => CarbonHijri::toHijriFromMiladi($this->meeting->meeting_at, 'l')]);
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
        if($this->meeting->type_id == \Modules\Committee\Entities\Meeting::FIRST)
            return [
                'message' => __('committee::notifications.update_first_meeting', ['number' => $this->committee->resource_staff_number,
                        'date' => $this->meeting->meeting_at, 'hall'=> $this->meeting->room->name, 'day' => CarbonHijri::toHijriFromMiladi($this->meeting->from, 'l')])

                    . ' ' . route('committee.meetings.show', [$this->committee, $this->meeting])
            ];

        elseif($this->meeting->type_id == \Modules\Committee\Entities\Meeting::COMPLEMENTARY)
           return[
               'message' => __('committee::notifications.update_complmentary_meeting', ['number' => $this->committee->resource_staff_number,
                       'date' => $this->meeting->meeting_at, 'hall'=> $this->meeting->room->name, 'day' => CarbonHijri::toHijriFromMiladi($this->meeting->from, 'l')])
                   . ' ' . route('committee.meetings.show', [$this->committee, $this->meeting])
           ];
    }
}
