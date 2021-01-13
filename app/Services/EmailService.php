<?php

namespace App\Services;

use App\Mail\CreateDepositAccount as MailCreateDepositAccount;

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
        User      $user,
        object $deposit
    ) {
        return Mail::to($user->email)->send(new MailCreateDepositAccount($user, $deposit));
    }
}
