<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
         $this->data = $data;
    }

    public function build()
    {
      //  return $this->view('view.name');
       // $subject =  $this->data['name'];
       return $this->from('almiqias')
                  ->subject(__('Welcome to Almiqias'))
                  ->view('mail.email_template')
                  ->with('data', $this->data);

    }

}
