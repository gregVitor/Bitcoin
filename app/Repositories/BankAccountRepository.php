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
     * @param string $type
     *
     * @return object
     */
    public function createAccountDeposit(
        int    $userId,
        float  $amount,
        string $type = 'deposit'
    ) {
        $deposit = $this->createTransactionAccount($userId, $type, $amount);

        $balance = $this->getBalance($userId);

        $data = (object) [
            'id'         => $deposit->id,
            'deposit'    => $deposit->amount,
            'balance'    => $balance,
            'created_at' => date('Y-m-d H:i:s', strtotime($deposit->created_at))
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
     * @return BankAccount
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

    /**
     * Function that debits money to create investment
     *
     * @param integer $userId
     * @param float $amount
     *
     * @return BankAccount
     */
    public function investmentAccount(
        int    $userId,
        float  $amount,
        string $type
    ) {
        $deposit = $this->createTransactionAccount($userId, $type, $amount);

        return $deposit;
    }

    /**
     * Function get Extract to filter
     *
     * @param integer $userId
     * @param object $data
     * @param object $paginator
     *
     * @return void
     */
    public function getExtract(
        int    $userId,
        object $data = null,
        object $paginator = null
    ) {

        $bankAccounts = $this->bankAccount->where('user_id', $userId);

        if (isset($data->initial_date)) {
            $bankAccounts = $bankAccounts->whereDate('created_at', '>=', date('Y-m-d', strtotime($data->initial_date)));
        } else {
            $bankAccounts = $bankAccounts->whereDate('created_at', '>=', date('Y-m-d', strtotime('- 90 days')));
        }

        if (isset($data->final_date)) {
            $bankAccounts = $bankAccounts->whereDate('created_at', '<=', date('Y-m-d', strtotime($data->final_date)));
        }

        if (!empty($paginator->per_page)) {
            $bankAccounts = $bankAccounts->paginate($paginator->per_page, ['*'], 'page', $paginator->page);
        } else {
            $bankAccounts = $bankAccounts->get();
        }

        $dataReturn = [];
        foreach ($bankAccounts as $bankAccount) {
            $data = (object) [
                'id'         => hashEncodeId($bankAccount->id),
                'amount'     => $bankAccount->amount,
                'type'       => $bankAccount->type,
                'created_at' => date('Y-m-d H:i', strtotime($bankAccount->created_at))
            ];

            $dataReturn[] = $data;
        }

        $arrayReturn = ['data' => $dataReturn];

        if (!empty($paginator->per_page)) {
            $paginate = [
                'total'             => $bankAccounts->total(),
                'current_page'      => $bankAccounts->currentPage(),
                'last_page'         => $bankAccounts->lastPage(),
                'per_page'          => $bankAccounts->perPage(),
                'next_page_url'     => $bankAccounts->nextPageUrl(),
                'previous_page_url' => $bankAccounts->previousPageUrl()
            ];
            $arrayReturn['paginate'] = $paginate;
        }

        return $arrayReturn;
    }

    /**
     * Function get bank accounts
     *
     * @param string $date
     *
     * @return void
     */
    public function getBankAccounts(
        string $date = null
    ) {
        $bankAccounts = $this->bankAccount;

        if (!empty($date)) {
            $bankAccounts = $bankAccounts->whereDate('created_at', '=', date('Y-m-d', strtotime($date)));
        }

        $bankAccounts = $bankAccounts->get();

        return $bankAccounts;
    }
}
