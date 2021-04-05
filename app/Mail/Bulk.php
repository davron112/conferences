<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Bulk extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('conferenceslistuz@gmail.com')
            ->subject('CONFERENCES-LIST.UZ - Yangi konferensiya haqida ma\'lumot')
            ->view('emails.request.yangi');
    }
}
