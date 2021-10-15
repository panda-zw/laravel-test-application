<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderFailed extends Mailable
{
    use Queueable, SerializesModels;
    public $order_id;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_id)
    {
        //
        $this->order_id = $order_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order_id = $this->order_id;
        return $this->subject('Order Failed')->view('email-templates.failed_payment', compact('order_id'));
    }
}
