<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionSuccess extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    private $transactions;
    private $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transactions, $name)
    {
        $this->transactions = $transactions;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.MAIL_FROM_ADDRESS'), config('app.name'))
            ->subject('Transaction')
            ->view('emails.email_success_transaction')
            ->with(
                [
                    'transactions'  => $this->transactions,
                    'name'         => $this->name
                ]
            );
    }
}
