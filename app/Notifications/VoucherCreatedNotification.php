<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VoucherCreatedNotification extends Notification
{
    use Queueable;
    public $voucher;
    /**
     * Create a new notification instance.
     */
    public function __construct($voucher)
    {
        $this->voucher = $voucher;
    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'voucher_id' => $this->voucher->id,
            'type' => 'new_voucher',
            'message' => 'A new voucher has been created!',
            'action' => 'Click To Activate',
        ];
    }
}
