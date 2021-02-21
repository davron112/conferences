<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReUploadMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $text;

    protected $hash;

    /**
     * CustomMessage constructor.
     * @param $text
     */
    public function __construct($hash, $text = '')
    {
        $this->hash = $hash;
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
            ->subject('CONFERENCES-LIST.UZ - Maqolangizni qayta yuklang!')
            ->view('emails.request.reupload', [
                'hash' => $this->hash,
                'text' => $this->text
            ]);
    }
}
