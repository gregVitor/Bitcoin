<?php

namespace App\Services\Transactions;

use App\Repositories\BankAccountRepository;
use App\Repositories\InvestmentRepository;
use App\Services\Bitcoin\BitcoinService;
use App\Services\EmailService;

class InvestmentService
{

    /**
     * @var BankAccountRepository
     */
    private $bankAccountRepository;

    /**
     * @var InvestmentRepository
     */
    private $investmentRepository;

    /**
     * @var BitcoinService
     */
    private $bitcoinService;

    /**
     * @var EmailService
     */
    private $emailService;

    /**
     * Class constructor method.
     *
     * @param BankAccountRepository $bankAccountRepository
     * @param InvestmentRepository $investmentRepository
     * @param BitcoinService $bitcoinService
     * @param EmailService $emailService
     */
    public function __construct(
        BankAccountRepository $bankAccountRepository,
        InvestmentRepository  $investmentRepository,
        BitcoinService        $bitcoinService,
        EmailService          $emailService
    ) {
        $this->bankAccountRepository = $bankAccountRepository;
        $this->investmentRepository  = $investmentRepository;
        $this->bitcoinService        = $bitcoinService;
        $this->emailService          = $emailService;
    }

    /**
     * Function create purchase
     *
     * @param object $user
     * @param array $values
     *
     * @return object
     */
    public function createPurchase(
        object $user,
        array  $values
    ) {
        $balance      = $this->bankAccountRepository->getBalance($user->id);
        $bitcoinPrice = $this->bitcoinService->getPrice();

        if (!empty($values['amount'])) {
            if ($values['amount'] > $balance) {
                abort(400, "Saldo insuficente, operação requer um investimento menor ou igual ao seu saldo em conta.");
            }
            $bitcoinUnits = $values['amount'] / $bitcoinPrice->buy;
            $appliedMoney = $values['amount'];
        } elseif ($balance < ($bitcoinPrice->buy * $values['units'])) {
            abort(400, "Saldo insuficente, operação requer um investimento menor ou igual ao seu saldo em conta.");
        } else {
            $bitcoinUnits = $values['units'];
            $appliedMoney = $bitcoinPrice->buy * $values['units'];
        }

        $investment = $this->createInvestment($user->id, $bitcoinUnits, $bitcoinPrice->buy, $appliedMoney);
        $this->emailService->sendEmailCreateInvestmentBitcoin($user, $investment);

        return $investment;
    }

    /**
     * Function create investment
     *
     * @param integer $userId
     * @param float $bitcoinUnits
     * @param float $bitcoinPrice
     * @param float $appliedMoney
     *
     * @return object
     */
    private function createInvestment(
        int   $userId,
        float $bitcoinUnits,
        float $bitcoinPrice,
        float $appliedMoney
    ) {
        $investment = $this->investmentRepository->createInvestment($userId, $bitcoinUnits, $bitcoinPrice, $appliedMoney);

        $investmentData = (object) [
            "id"               => hashEncodeId($investment->id),
            "user_id"          => hashEncodeId($investment->user_id),
            "purchase_price"   => $investment->bitcoin_price,
            "amount"           => $investment->applied_money,
            "purchased_amount" => $investment->bitcoin_quantity,
            "created_at"       => date('Y-m-d H:i:s', strtotime($investment->created_at)),
            "liquidated_at"    => $investment->deleted_at != null ? date('Y-m-d H:i:s', strtotime($investment->deleted_at)) : null
        ];

        $this->bankAccountRepository->investmentAccount($userId, $appliedMoney * -1);

        return $investmentData;
    }
}