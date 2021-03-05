<?php

namespace App\Console\Commands;

use App\Mail\Bulk;
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
            if ($item->status == Request::STATUS_APPROVED && $item->id == 8) {

                $text = "<p>Sizga ushbu onlayn konferensiya havolasi(linki) o'zgarganini ma'lum qilamiz. Yangi link quyida ko'rsatilingan.<br><strong>Seksiya</strong>:&nbsp;8<br /><strong>Mavzu</strong>: Dasturiy mahsulotlarni yaratish va uning istiqbollari<br /><strong>Vaqti</strong>: 5 mart. 2021 09:00 AM Toshkent<br /><br /><strong>Zoom konferensiyaga ulanish linki:</strong><br /><a href='https://us02web.zoom.us/j/82231134743?pwd=dnJ2SFAwTmR0azhwYXFtTHZIbS93UT09'>https://us02web.zoom.us/j/82231134743?pwd=dnJ2SFAwTmR0azhwYXFtTHZIbS93UT09</a></p>
<p><strong>ID zoom</strong>: 822 3113 4743<br /><strong>Kirish kodi</strong>: 123456</p>";
                Mail::to($item->email)
                    ->send(new Bulk($text));
                var_dump('Konferensiya: ' . $item->id);
                var_dump('User: ' . $item->email);

                if ($item->phone) {
                    $textSms2 = "Onlayn konferensiya linki o'zgardi. Zoom: https://us02web.zoom.us/j/82231134743?pwd=dnJ2SFAwTmR0azhwYXFtTHZIbS93UT09 Kirish kodi: 123456 ID zoom: 82231134743.";
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
