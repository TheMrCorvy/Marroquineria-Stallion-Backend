<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifySeller extends Mailable
{
    use Queueable, SerializesModels;

    public $sales;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sales_list)
    {
        $this->sales = $sales_list;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.notify-seller')->subject('Notificación de venta desde la Página Web');
    }
}
