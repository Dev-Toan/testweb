<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPasswordLoginGoogle extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $name;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.MAIL_FROM_ADDRESS'), config('app.name'))
            ->subject('Send Password')
            ->view('emails.email_send_password_login_google')->with(['name' => $this->name, 'password' => $this->password]);
    }
}
