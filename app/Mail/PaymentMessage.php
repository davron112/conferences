<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $link;

    protected $requestModel;

    /**
     * PaymentMessage constructor.
     * @param $id
     * @param string $link
     */
    public function __construct($requestModel, $link = '')
    {
        $this->requestModel = $requestModel;
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
            ->subject('CONFERENCES-LIST.UZ - #' . $this->requestModel->id . ' maqolaga to\'lovni amalga oshiring')
            ->view('emails.request.payment', ['link' => $this->link, 'requestModel' => $this->requestModel]);
    }
}
