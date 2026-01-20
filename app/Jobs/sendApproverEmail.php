<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\req;
use App\mail\approverMail;
use Illuminate\Support\Facades\Mail;


class sendApproverEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
	public $form, $ky;
	
    public function __construct(req $a, $b)
    {
        //
		$this->form = $a;
		$this->ky =  $b;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
		Mail::to(explode(';', $this->form->hod)[$this->ky])->send(new approverMail($this->form, $this->ky));		
		
    }
}
