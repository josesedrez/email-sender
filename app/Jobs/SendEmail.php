<?php

namespace App\Jobs;

use App\Mail\Send;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $toEmail;
    public $subject;
    public $currentMessage;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($toEmail, $subject, $currentMessage)
    {
        $this->toEmail = $toEmail;
        $this->subject = $subject;
        $this->currentMessage = $currentMessage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->toEmail)->send(new Send($this->subject, $this->currentMessage));
    }
}
