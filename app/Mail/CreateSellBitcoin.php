<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateSellBitcoin extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $user;
    private $quantityBitcoinSell;
    private $amountRescued;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $user,
        $quantityBitcoinSell,
        $amountRescued
    ) {
        $this->user                = $user;
        $this->quantityBitcoinSell = $quantityBitcoinSell;
        $this->amountRescued       = $amountRescued;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $objEmail = [
            'name'                => $this->user->name,
            'quantityBitcoinSell' => $this->quantityBitcoinSell,
            'amountRescued'       => $this->amountRescued,
            'date'                => date('Y-m-d H:i:s')
        ];

        $address = env('MAIL_FROM_DEFAULT');
        $name    = env('APP_NAME');
        $subject = 'Venda Realizado';

        return $this->view('email.transactions.sell-investment')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with($objEmail);
    }
}
