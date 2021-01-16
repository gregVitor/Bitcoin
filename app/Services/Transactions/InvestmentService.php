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
     * @param object $values
     *
     * @return object
     */
    public function createPurchase(
        object $user,
        object $values
    ) {
        $balance      = $this->bankAccountRepository->getBalance($user->id);
        $bitcoinPrice = $this->bitcoinService->getPrice();

        if (!empty($values->amount)) {
            if ($values->amount > $balance) {
                abort(400, "Saldo insuficente, operação requer um investimento menor ou igual ao seu saldo em conta.");
            }
            $bitcoinUnits = $values->amount / $bitcoinPrice->buy;
            $appliedMoney = $values->amount;
        } elseif ($balance < ($bitcoinPrice->buy * $values->units)) {
            abort(400, "Saldo insuficente, operação requer um investimento menor ou igual ao seu saldo em conta.");
        } else {
            $bitcoinUnits = $values->units;
            $appliedMoney = $bitcoinPrice->buy * $values->units;
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
     * @param bool  $reinvest
     *
     * @return object
     */
    private function createInvestment(
        int   $userId,
        float $bitcoinUnits,
        float $bitcoinPrice,
        float $appliedMoney,
        bool  $reinvest = false

    ) {
        $investment = $this->investmentRepository->createInvestment($userId, $bitcoinUnits, $bitcoinPrice, $appliedMoney);

        $investmentData = (object) [
            "id"               => hashEncodeId($investment->id),
            "user_id"          => hashEncodeId($investment->user_id),
            "purchase_price"   => $investment->bitcoin_price,
            "amount"           => $investment->applied_money,
            "purchased_amount" => $investment->bitcoin_quantity,
            "created_at"       => date('Y-m-d H:i:s', strtotime($investment->created_at)),
            "liquidated_at"    => null != $investment->deleted_at ? date('Y-m-d H:i:s', strtotime($investment->deleted_at)) : null
        ];

        $this->bankAccountRepository->investmentAccount($userId, $appliedMoney * -1, true == $reinvest ? 'reinvest_buy_bitcoin' : 'buy_bitcoin');

        return $investmentData;
    }

    /**
     * Function get investments
     *
     * @param integer $userId
     *
     * @return void
     */
    public function getInvestmentsPositions(int $userId)
    {
        $bitcoinPrice = $this->bitcoinService->getPrice();
        $investments  = $this->investmentRepository->getInvestments($userId);

        $dataReturn = [];

        foreach ($investments as $investment) {
            $percentageAmount = ($bitcoinPrice->buy * 100) / $investment->bitcoin_price;

            $data = (object) [
                "id"                   => hashEncodeId($investment->id),
                "applied_money"        => $investment->applied_money,
                "purchase_price"       => $investment->bitcoin_price,
                "bitcoin_quantity"     => $investment->bitcoin_quantity,
                "sell_amount"          => $investment->bitcoin_quantity * $bitcoinPrice->sell,
                "variation_amount"     => $bitcoinPrice->buy - $investment->bitcoin_price,
                "variation_percentage" => $percentageAmount - 100,
                "purchased_date"       => date('Y-m-d H:i:s', strtotime($investment->created_at)),
                "bitcoin"              => (object) [
                    "current_price_buy"  => $bitcoinPrice->buy,
                    "current_price_sell" => $bitcoinPrice->sell
                ]
            ];

            $dataReturn[] = $data;
        }

        return $dataReturn;
    }

    /**
     * Function to sell bitcoin and Rescued Money for bank account
     *
     * @param object $user
     * @param float $amount
     *
     * @return bool
     */
    public function sellBitcoin(
        object $user,
        float  $amount
    ) {
        $bitcoinPrice        = $this->bitcoinService->getPrice();
        $investments         = $this->investmentRepository->getInvestments($user->id);
        $quantityBitcoinSell = $amount / $bitcoinPrice->sell;

        if ($investments->sum('bitcoin_quantity') < $quantityBitcoinSell) {
            abort(403, 'Você não possui bitcoins sufientes para essa ação');
        }

        foreach ($investments as $investment) {
            $balance             = $investment->bitcoin_quantity - $quantityBitcoinSell;
            $quantityBitcoinSell = $balance * (-1); //$quantityBitcoinSell - $investment->bitcoin_quantity;

            $this->bankAccountRepository->createAccountDeposit($user->id, $amount, 'sell_bitcoin');

            if ($quantityBitcoinSell <= 0) {
                $deletedInvestment = $this->investmentRepository->sellInvestment($investment->id);
                $newAmount         = $deletedInvestment->bitcoin_price * $balance;

                $this->bankAccountRepository->investmentAccount($user->id, $newAmount, 'partial_draft');
                $this->createInvestment($user->id, $balance, $deletedInvestment->bitcoin_price, $newAmount, true);

                break;
            } else {
                $this->investmentRepository->sellInvestment($investment->id);
            }
        }

        $this->emailService->sendEmailCreateSellBitcoin($user, $amount / $bitcoinPrice->sell, $amount);

        return true;
    }
}
