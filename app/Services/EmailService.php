<?php

namespace App\Services;

use App\Mail\CreateDepositAccount as MailCreateDepositAccount;
use App\Mail\CreateInvestmentBitcoin as MailCreateInvestmentBitcoin;
use App\Mail\CreateSellBitcoin as MailCreateSellBitcoin;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailService extends Mail
{

    /**
     * Send email deposit
     *
     * @param User $user
     * @param object $deposit
     * @return void
     */
    public function sendEmailCreateDepositAccount(
        User   $user,
        object $deposit
    ) {
        return Mail::to($user->email)->send(new MailCreateDepositAccount($user, $deposit));
    }

    /**
     * Send email investment
     *
     * @param User $user
     * @param object $investment
     * @return void
     */
    public function sendEmailCreateInvestmentBitcoin(
        User   $user,
        object $investment
    ) {
        return Mail::to($user->email)->send(new MailCreateInvestmentBitcoin($user, $investment));
    }

    /**
     * Send email to sell Bitcoin rescued money
     *
     * @param User $user
     * @param float $quantityBitcoinSell
     * @param float $amountRescued
     *
     * @return void
     */
    public function sendEmailCreateSellBitcoin(
        User  $user,
        float $quantityBitcoinSell,
        float $amountRescued
    ) {
        return Mail::to($user->email)->send(new MailCreateSellBitcoin($user, $quantityBitcoinSell, $amountRescued));
    }
}
