<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AskForFund extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $name;

    public $email;

    public $phone;

    public $mail_body;

    public function __construct($name, $email, $phone, $mail_body)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->mail_body = $mail_body;
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
        return (new MailMessage)
                    ->subject('Pedido de cotización desde la página web')
                    ->line("$this->name te envió una consulta desde la página web pidiendo por una cotización.")
                    ->line("Su número de teléfono es: $this->phone")
                    ->line("Su email es: $this->email")
                    ->line("Su consulta es la siguiente:")
                    ->line($this->mail_body);
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
