<?php

namespace App\Services\Transactions;

use App\Repositories\BankAccountRepository;
use App\Services\EmailService;

class BankAccountService
{
    /**
     * @var BankAccountRepository
     */
    private $bankAccountRepository;

    /**
     * @var EmailService
     */
    private $emailService;

    /**
     * Class constructor method.
     *
     */
    public function __construct(
        BankAccountRepository $bankAccountRepository,
        EmailService          $emailService

    ) {
        $this->bankAccountRepository = $bankAccountRepository;
        $this->emailService          = $emailService;
    }

    /**
     * Function create deposit
     * after send email
     *
     * @param object $user
     * @param float $amount
     *
     * @return void
     */
    public function createAccountDeposit(
        object $user,
        float  $amount
    ) {
        $balance = $this->bankAccountRepository->createAccountDeposit($user->id, $amount);
        $balance->id = hashEncodeId($balance->id);

        $this->emailService->sendEmailCreateDepositAccount($user, $balance);

        return ($balance);
    }
}
