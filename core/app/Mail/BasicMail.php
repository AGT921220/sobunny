<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BasicMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public function __construct($args)
    {
        $this->data = $args;
    }
    public function build()
    {
        return $this->from(get_static_option('site_global_email'), get_static_option('site_title'))
            ->subject($this->data['subject'])
            ->markdown('mail.basic-mail-template');
    }
}
