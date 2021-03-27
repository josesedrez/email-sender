<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Send extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;

    public $currentMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $currentMessage)
    {
        $this->subject = $subject;

        $this->currentMessage = $currentMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('chapavamosdeboas@gmail.com')
            ->subject($this->subject)
            ->view('email');
    }
}
