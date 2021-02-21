<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $link;

    protected $id;

    /**
     * PaymentMessage constructor.
     * @param $id
     * @param string $link
     */
    public function __construct($id, $link = '')
    {
        $this->id = $id;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('conferenceslistuz@gmail.com')
            ->subject('CONFERENCES-LIST.UZ - To\'lovni amalga oshiring')
            ->view('emails.request.payment', ['link' => $this->link, 'id' => $this->id]);
    }
}
