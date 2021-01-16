<?php

namespace App\Repositories;

use App\Models\Investment;

class InvestmentRepository
{

    /**
     * @var Investment
     */
    private $investment;

    /**
     * Class constructor method.
     *
     * @param Investment $investment
     */
    public function __construct(
        Investment $investment
    ) {
        $this->investment = $investment;
    }

    /**
     * Function create investment
     *
     * @param integer $userId
     * @param float $bitcoinQuantity
     * @param float $bitcoinPrice
     * @param float $appliedMoney
     *
     * @return Investment
     */
    public function createInvestment(
        int   $userId,
        float $bitcoinQuantity,
        float $bitcoinPrice,
        float $appliedMoney
    ) {
        $investment = $this->investment->create(
            [
                'user_id'          => $userId,
                'bitcoin_quantity' => $bitcoinQuantity,
                'bitcoin_price'    => $bitcoinPrice,
                'applied_money'    => $appliedMoney
            ]
        );

        return $investment;
    }

}
