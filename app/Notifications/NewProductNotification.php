<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewProductNotification extends Notification
{
    use Queueable;

    public $productName;

    public function __construct($productName)
    {
        $this->productName = $productName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'New product created: ' . $this->productName
        ];
    }
}
