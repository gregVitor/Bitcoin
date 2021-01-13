<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateDepositAccount extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $user;
    private $deposit;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $user,
        $deposit
    ) {
        $this->user    = $user;
        $this->deposit = $deposit;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $objEmail = [
            'name'          => $this->user->name,
            'email'         => $this->user->email,
            'depositId'     => $this->deposit->id,
            'depositAmount' => $this->deposit->deposit,
            'createdAt'     => $this->deposit->created_at
        ];

        $address = env('MAIL_FROM_DEFAULT');
        $name    = env('APP_NAME');
        $subject = 'Deposito Realizado';

        return $this->view('email.transactions.deposit-account')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with($objEmail);
    }
}
