<?php

namespace App\Channels;

use App\Classes\Mobily;
use Illuminate\Notifications\Notification;

class MobilyChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $notificationObject = $notification->toMobily($notifiable);
        $msg = $notificationObject['message'];
        Mobily::sendMessage($msg,  $notifiable->phone_number);
    }
}
