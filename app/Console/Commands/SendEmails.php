<?php

namespace App\Console\Commands;

use App\Mail\RequestCreatedAdmin;
use App\Mail\RequestCreatedClient;
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
    protected $signature = 'command:name';

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
            Mail::to($item->email)
                ->send(new RequestCreatedClient($item));
            var_dump('User: ' . $item->email);

            Mail::to($item->category->owner_email)
                ->send(new RequestCreatedAdmin($item));
            var_dump('Owner: ' . $item->category->owner_email);
        }
    }
}