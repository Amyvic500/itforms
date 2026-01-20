<?php

namespace App\Console\Commands;
use App\req;
use App\user;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Mail\sendDailyPendingMail;
use App\Jobs\sendDailyPendingJob;
use Carbon\Carbon;


class sendDailyPending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends daily imcomplete ITForms to admins';

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
        //
		$r = req::whereNotIn('apprStatus', [8, 28, 40])->orWhere('apprStatus', NULL)->get();
		$u = User::where('admin', 1)->get();
		if(!$r->isEmpty()){
		foreach($u as $user){
		//Mail::to($user->email)->send(new sendDailyPendingMail($r, $u, $user))
		dispatch((new sendDailyPendingJob($r, $u, $user))->delay(Carbon::now()->addMinutes(1)));
							}
		}		
		echo "successfully process imcomplete ITFroms";
    }
}
