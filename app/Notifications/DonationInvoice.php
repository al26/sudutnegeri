<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use App\Project;

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
    public function __construct(User $user, $slug, $donation)
    {
        $this->user = $user;
        $this->slug = $slug;
        $this->donation = $donation;
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
        $project = Project::where('project_slug', $this->slug)->first();

        return (new MailMessage)->subject('Faktur investasi proyek')
                                ->markdown('mail.donation.invoice', ['user' => $this->user, 'project' => $project, 'donation' => $this->donation]);
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
