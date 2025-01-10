<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FeatureNotification extends Notification
{
    use Queueable;
    public $brand;

    /**
     * Create a new notification instance.
     */
    public function __construct($brand)
    {
        $this->brand = $brand;
    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'brand_id' => $this->brand->id,
            'type' => 'new_feature_request',
            'message' =>  $this->brand->name.' wanted to be Featured',
            'action' => 'Click To Feature',
        ];
    }
}
