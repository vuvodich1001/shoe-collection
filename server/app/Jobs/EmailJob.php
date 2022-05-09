<?php

namespace App\Jobs;

use App\Mail\SaleMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderDetails, $orderId, $user, $fees;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderDetails, $fees, $orderId, $user) {
        $this->orderDetails = $orderDetails;
        $this->orderId = $orderId;
        $this->user = $user;
        $this->fees = $fees;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $mailable = new SaleMail($this->orderDetails, $this->fees, $this->orderId);
        Mail::to($this->user)->send($mailable);
    }
}
