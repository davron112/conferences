<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $text;

    /**
     * CustomMessage constructor.
     * @param $text
     */
    public function __construct($text = '')
    {
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('conferenceslistuz@gmail.com')
            ->subject('CONFERENCES-LIST.UZ - Xabar')
            ->view('emails.request.custom', ['text' => $this->text]);
    }
}
