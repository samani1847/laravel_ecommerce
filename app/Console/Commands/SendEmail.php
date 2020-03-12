<?php

namespace OneStop\Console\Commands;

use Illuminate\Console\Command;
use OneStop\User;
use OneStop\Mail\MailExample;
use Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:all';

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
     * @return mixed
     */
    public function handle()
    {
        $this->sendAll();

    }

    private function sendAll()
    {
        $users = User::all();
        foreach ($users as $key => $user) {
            Mail::to($user)->send(new MailExample());
        }

    }
}
