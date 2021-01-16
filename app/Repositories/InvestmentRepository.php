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

    /**
     * Function get investments
     *
     * @param integer $userId
     *
     * @return Investment
     */
    public function getInvestments(int $userId)
    {
        $investments = $this->investment->where('user_id', $userId)->get();

        return $investments;
    }

    /**
     * Function return investment for delete
     *
     * @param integer $investmentId
     *
     * @return Investment
     */
    public function sellInvestment(int $investmentId)
    {
        $investment = $this->investment->where('id', $investmentId)->first();

        $this->deleteInvestment($investmentId);

        return $investment;
    }

    /**
     * Function delete investment
     *
     * @param integer $investmentId
     *
     * @return Investment
     */
    private function deleteInvestment(int $investmentId)
    {
        $investment = $this->investment->where('id', $investmentId)->delete();

        return $investment;
    }

}
