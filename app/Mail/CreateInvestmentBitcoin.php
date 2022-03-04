<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateInvestmentBitcoin extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $user;
    private $investment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $user,
        $investment
    ) {
        $this->user       = $user;
        $this->investment = $investment;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $objEmail = [
            'name'             => $this->user->name,
            'investmentId'     => $this->investment->id,
            'investmentAmount' => $this->investment->amount,
            'purchasedAmount'  => $this->investment->purchased_amount,
            'createdAt'        => $this->investment->created_at
        ];

        $address = env('MAIL_FROM_DEFAULT');
        $name    = env('APP_NAME');
        $subject = 'Investimento Realizado';

        return $this->view('email.transactions.investment')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with($objEmail);
    }
}
