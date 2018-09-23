<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;

class DonationInvoice extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $donation;
    protected $slug;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $slug)
    {
        $this->user = $user;
        $this->slug = $slug;
        // $this->donation = $donation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('donation.invoice', ['slug' => $this->slug]);

        return (new MailMessage)
                    ->greeting('Hello!'.$this->user->profile->name)
                    ->line('One of your invoices has been paid!')
                    ->action('View Invoice', $url)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
