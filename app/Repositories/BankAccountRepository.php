<?php

namespace App\Repositories;

use App\Models\BankAccount;

class BankAccountRepository
{

    /**
     * @var BankAccount
     */
    private $bankAccount;

    /**
     * Class constructor method.
     *
     * @param BankAccount $bankAccount
     */
    public function __construct(
        BankAccount $bankAccount
    ) {
        $this->bankAccount = $bankAccount;
    }

    /**
     * Function get balance user
     *
     * @param object $data
     * @return float
     */
    public function getBalance(
        int $userId
    ) {
        $balance = $this->bankAccount->where('user_id', $userId)->sum('amount');
        return round($balance, 2);
    }

    /**
     * Function account deposit
     *
     * @param integer $userId
     * @param float $amount
     *
     * @return object
     */
    public function createAccountDeposit(
        int   $userId,
        float $amount
    ) {
        $deposit = $this->createTransactionAccount($userId, 'deposit', $amount);

        $balance = $this->getBalance($userId);

        $data = [
            'deposit' => $deposit->amount,
            'balance' => $balance
        ];

        return $data;
    }

    /**
     * Function create transaction account
     *
     * @param integer $userId
     * @param float $amount
     * @param string $type
     *
     * @return object
     */
    private function createTransactionAccount(
        int    $userId,
        string $type,
        float  $amount
    ) {
        $account = $this->bankAccount->create([
            "user_id" => $userId,
            "type"    => $type,
            "amount"  => $amount
        ]);

        return $account;
    }
}
