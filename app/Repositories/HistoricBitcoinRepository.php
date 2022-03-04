<?php

namespace App\Repositories;

use App\Models\HistoricBitcoin;

class HistoricBitcoinRepository
{
    /**
     * @var HistoricBitcoin
     */
    private $historicBitcoin;

    /**
     * Class constructor method.
     *
     * @param HistoricBitcoin $historicBitcoin
     */
    public function __construct(
        HistoricBitcoin $historicBitcoin
    ) {
        $this->historicBitcoin = $historicBitcoin;
    }

    /**
     * Create Historic Bitcoin
     *
     * @param float $buy
     * @param float $sell
     *
     * @return HistoricBitcoin
     */
    public function createHistoryBitcoin(
        float $buy,
        float $sell
    ) {
        $historicBitcoin = $this->historicBitcoin->create([
            "buy"  => $buy,
            "sell" => $sell
        ]);

        return $historicBitcoin;
    }

    /**
     * Function that delete Historic Bitcoin after 90 days
     */
    public function deleteHistoricBitcoin()
    {
        return $this->historicBitcoin->whereDate('created_at', '<', date('Y-m-d', strtotime('- 90 days')))->delete();
    }

    /**
     * Function get Historic Bitcoin
     *
     * @return HistoricBitcoin
     */
    public function getHistoricBitcoin()
    {
        $historicBitcoin = $this->historicBitcoin->get();

        $data = [];
        foreach ($historicBitcoin as $historic) {
            $data[] = (object) [
                'buy'        => $historic->buy,
                'sell'       => $historic->sell,
                'created_at' => date('Y-m-d', strtotime($historic->created_at))
            ];
        }

        return $data;
    }
}
