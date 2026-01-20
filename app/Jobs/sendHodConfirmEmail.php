<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\req;
use App\mail\hodConfirmEmail;
use Illuminate\Support\Facades\Mail;


class sendHodConfirmEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
	 public $form, $email;	 	 
    public function __construct(req $a, $b)
    {
        //
		$this->form = $a;
		$this->email = $b;			
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
		Mail::to($this->email)->send(new hodConfirmEmail($this->form, $this->email));			
    }
}
