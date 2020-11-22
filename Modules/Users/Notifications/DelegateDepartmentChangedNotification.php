<?php


namespace Modules\Users\Notifications;


use App\Channels\MobilyChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DelegateDepartmentChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $committee;
    private $delegate;
    private $message;
    private $old_department;

    /**
     * Create a new notification instance.
     *
     * @param $committee
     */
    public function __construct($delegate, $committee, $message, $old_department)
    {
        $this->committee = $committee;
        $this->delegate = $delegate;
        $this->message = $message;
        $this->old_department =  $old_department;
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
            ->subject(__('users::delegates.delegate_department_changed') . ' ' . $this->delegate->name)
            ->markdown('users::emails.delegate_nomination_department_changed', ['committee' => $this->committee,'delegate'=>$this->delegate,'message'=>$this->message, 'old_department' => $this->old_department]);
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
            'message' => $this->message,
            'notified_user' => $notifiable
        ];
    }

    public function toMobily($notifiable)
    {
        return [
            'message' => __('users::delegates.replace_delegate_from_committee')
                . ' ' . $this->delegate->name . ' ' . __('users::delegates.delegate_in_department_before', ['name' => $this->old_department->name])
                . ' ' . route('committees.show', $this->committee)
        ];
    }
}
