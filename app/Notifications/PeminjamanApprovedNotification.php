<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PeminjamanApprovedNotification extends Notification
{
    use Queueable;

    public $request_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request_user)
    {
        $this->request_user = $request_user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Use a broadcast driver for real-time notifications
        return ['broadcast'];
    }

    // ... implement broadcastOn() and toBroadcast() methods if needed ...

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Permintaan anda di setujui silahkan mengambil barang tersebut',
            'peminjaman_id' => $this->request_user->id,
        ];
    }

}
