<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

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
        $user = [
            'email' => 'kyrieup@gmail.com',//一个有效的邮箱接收地址
            'name'  => 'kyrieup',
        ];
        \Mail::send('emails.send', ['user'=>$user], function($msg) use ($user){
            $msg->to($user['email'], $user['name'])->subject('This is a demo about sending emails to myself');
        });

        $this->info('Success to send email');exit;
    }
}
