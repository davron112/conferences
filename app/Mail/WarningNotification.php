<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WarningNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $model;

    /**
     * CustomMessage constructor.
     * @param $model
     */
    public function __construct(Request $model)
    {
        $this->model = $model;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('conferenceslistuz@gmail.com')
            ->subject('CONFERENCES-LIST.UZ - To\'lovni amalga oshirish to\'g\'risida ogohlantirish')
            ->view('emails.request.warning', ['requestModel' => $this->model]);
    }
}
