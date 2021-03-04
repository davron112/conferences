<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulkToMeeting extends Mailable
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
            ->subject('4-5 mart kunlari konferensiyada ishtirok etish uchun taklif etamiz. Batafsil ma\'lumot pochtangizga jo\'natilindi. Qo\'shimcha havola http://conferences-list.uz/jadval da.')
            ->view('emails.request.meeting', ['requestModel' => $this->model]);
    }
}
