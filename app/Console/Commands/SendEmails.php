<?php

namespace App\Console\Commands;

use App\Mail\BulkToMeeting;
use App\Mail\CustomMessage;
use App\Mail\RequestCreatedAdmin;
use App\Mail\RequestCreatedClient;
use App\Mail\WarningNotification;
use App\Models\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userRequests = Request::all();
        foreach ($userRequests as $item) {
            $statusChanged = false;
            if ($item->status == Request::STATUS_APPROVED) {
                Mail::to($item->email)
                    ->send(new BulkToMeeting($item));
                var_dump('Konferensiya: ' . $item->id);
                var_dump('User: ' . $item->email);

                if ($item->phone) {
                    $textSms = "4-5-mart kunlari konferensiyada ishtirok etishing. Batafsil: https://conferences-list.uz/jadval";
                    $this->sendSms($item->phone, $textSms);
                    $textSms2 = "conferences-list.uz - Bugun soat 10:00 da konferensiyaning ochilishida ishtitok eting. Oflayn: TATU, kichik majlislar zali, Onlayn: https://us02web.zoom.us/j/83914614041?pwd=YkVnNlpxblp5ems2eklvbU43SWNFQT09%20 Kirish kodi: 764643 ID zoom: 83914614041.";
                    $this->sendSms($item->phone, $textSms2);
                }

            }
            /*if ($item->send_owner == 0) {
                Mail::to($item->category->owner_email)
                    ->send(new RequestCreatedAdmin($item));
                var_dump('Owner: ' . $item->category->owner_email);
                $statusChanged = true;
                $item->send_owner = 1;

            }*/

            /*if ($statusChanged) {
                $item->save();
            }*/
        }
    }


    /**
     * @param $phone
     * @param $text
     * @return bool|string
     */
    public function sendSms($phone, $text) {
        $data = [
            'recipient_number' => "+". $phone,
            'message' => $text,
            'app_id' => config('services.sms.app_id')
        ];

        $url = 'https://smsapi.uz/api/v1/sms/send';
        $headers = [
            'Authorization: Bearer ' . config('services.sms.api_key'),
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
