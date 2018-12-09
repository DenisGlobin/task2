<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderAdded extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $order;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.neworder')
            ->with([
                'id' => $this->order->id,
                'title' => $this->order->title,
                'text' => $this->order->message,
                'name' => $this->order->user->name,
                'email' => $this->order->user->email,
                'file' => $this->order->file_path,
                'createdAt' => $this->order->created_at,
            ]);
    }
}
