<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewProductNotification extends Notification
{
    use Queueable;

    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        return ['database', 'mail', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->subject('New Product Created!')
                    ->greeting('Hello!')
                    ->line('A new product has been created: ' . $this->product->name)
                    ->line('Price: $' . number_format($this->product->price, 2))
                    ->action('View Products', url('/index'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'product_id' => $this->product->id,
            'message' => 'New product created: ' . $this->product->name,
            'price' => $this->product->price
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new \Illuminate\Notifications\Messages\BroadcastMessage([
            'message' => 'New product created: ' . $this->product->name,
            'product_name' => $this->product->name,
            'price' => number_format($this->product->price, 2)
        ]);
    }
}
