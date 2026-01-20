<?php

namespace App\Mail;

use App\req;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class approverMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	 public $form, $ky;
    public function __construct(req $a, $b)
    {
        //
		$this->form = $a;
		$this->ky = $b;
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
		$subject = 'HOD Approval Request';
        return $this->view('email.approve')
					->from($address, $name)
					->subject($subject)->with(['form'=>$this->form,'key'=>$this->ky]);
    }
}
