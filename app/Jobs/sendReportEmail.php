<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\req;
use App\mail\reportEmail;
use Illuminate\Support\Facades\Mail;


class sendReportEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
	public $form;	 
    public function __construct(req $a)
    {
        //
		$this->form = $a;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
		Mail::to($this->form->hod)->cc(array("yonatan.refa@esrnl.com","ketut.widiarta@primerafood-nigeria.com"))->bcc('hallitee_2005@yahoo.com')->send(new reportEmail($this->form));
		
    }
}
