<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BrandCreatedNotification extends Notification
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
            'type' => 'new_brand',
            'message' => 'A new brand has been created!',
            'action' => 'Click To Activate',
        ];
    }
}
