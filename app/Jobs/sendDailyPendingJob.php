<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\req;
use App\User;
use App\mail\sendDailyPendingMail;
use Illuminate\Support\Facades\Mail;


class sendDailyPendingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
	 public $req, $users, $mine;
    public function __construct($a, $b, $c)
    {
        //
		
		$this->req = $a;
		$this->users = $b;
		$this->mine = $c;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
		Mail::to($this->mine->email)->send(new sendDailyPendingMail($this->req, $this->users, $this->mine));
    }
}
