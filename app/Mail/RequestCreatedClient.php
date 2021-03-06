<?php

namespace App\Mail;

use App\Models\Request as RequestModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestCreatedClient extends Mailable
{
    use Queueable, SerializesModels;

    protected $requestModel;

    /**
     * RequestCreated constructor.
     * @param RequestModel $requestModel
     */
    public function __construct(RequestModel $requestModel)
    {
        $this->requestModel = $requestModel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('conferenceslistuz@gmail.com')
            ->subject('CONFERENCES-LIST.UZ - Maqola #' . $this->requestModel->id)
            ->view('emails.request.client', ['requestModel' => $this->requestModel]);
    }
}
