<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SaleMail extends Mailable {
    use Queueable, SerializesModels;

    protected $orderDetails, $orderId, $fees;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderDetails, $fees, $orderId) {
        $this->orderDetails = $orderDetails;
        $this->orderId = $orderId;
        $this->fees = $fees;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('ShoeCollection đã nhận đơn hàng #' . $this->orderId)
            ->view('mail', [
                'orderDetails' => $this->orderDetails,
                'fees' => $this->fees,
                'orderId' => $this->orderId
            ]);
    }
}
