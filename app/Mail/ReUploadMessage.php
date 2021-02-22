<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReUploadMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $text;

    protected $requestModel;

    /**
     * CustomMessage constructor.
     * @param $text
     */
    public function __construct($requestModel, $text = '')
    {
        $this->requestModel = $requestModel;
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
            ->subject('CONFERENCES-LIST.UZ - #' . $this->requestModel->id . ' maqolangizni qayta yuklang!')
            ->view('emails.request.reupload', [
                'requestModel' => $this->requestModel,
                'text' => $this->text
            ]);
    }
}
