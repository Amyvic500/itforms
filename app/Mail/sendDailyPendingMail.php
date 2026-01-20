<?php

namespace App\Mail;
use App\req;
use App\user;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class sendDailyPendingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = config('mail.from.address');
		$name = 'IT FORM REPORT';
		$subject = 'Pending Request For  '.date('d-M-Y');
        return $this->view('email.dailyreport')
					//->bcc($this->m->bcopy)
					->from($address, $name)
					->subject($subject)->with(['req'=>$this->req, 'users'=>$this->users, 'mine'=>$this->mine]);
    }
}
