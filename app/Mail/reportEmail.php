<?php

namespace App\Mail;

use App\req;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class reportEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = config('mail.from.address');
		$name = 'IT REQUEST FORM';
		$subject = 'Report request';
        return $this->view('email.report')
					->from($address, $name)
					->subject($subject)->with(['form'=>$this->form]);
    }
}
