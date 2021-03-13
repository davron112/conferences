<?php

namespace App\Console\Commands;


use App\Models\Request;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            $user = User::updateOrCreate([
                'email' => $item->email
            ], [
                'phone' => $item->phone,
                'role' => 'USER',
                'password' => Hash::make(Str::random(8))
            ]);

            $item->user_id = $user->id;
            $item->save();
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
