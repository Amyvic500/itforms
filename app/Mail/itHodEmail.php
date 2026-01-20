<?php

namespace App\Mail;

use App\req;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class itHodEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = config('mail.from.address');
		$name = 'IT REQUEST FORM';
		$subject = 'IT Approval for'.$this->form->curr;
        return $this->view('email.hod')
					->from($address, $name)
					->subject($subject)->with(['form'=>$this->form, 'email'=>$this->email]);
    }
}
