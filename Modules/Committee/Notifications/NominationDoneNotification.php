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
    private $department;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($committee, $department)
    {
        $this->committee = $committee;
        $this->department = $department;

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
            ->subject(__('committee::committees.nomination done for committee') . ' ' . $this->committee->subject)
            ->markdown('committee::emails.nomination_done', ['committee' => $this->committee, 'department' => $this->department]);
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
            'message' => __('committee::committees.committee_nomination_advisors',
                ['number' => $this->committee->resource_staff_number, 'department'=> $this->department])
                . ' ' . route('committees.show', $this->committee)
        ];
    }
}
