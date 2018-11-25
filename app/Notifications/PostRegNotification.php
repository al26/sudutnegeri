<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostRegNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $project;
    protected $volunteer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($project, $volunteer)
    {
        $this->project = $project;
        $this->volunteer = $volunteer;
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
        return (new MailMessage)->subject('Sudut Negeri : Pendaftaran relawan')
                                ->markdown('mail.postreg', ['project' => $this->project, 'volunteer' => $this->volunteer]);
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
