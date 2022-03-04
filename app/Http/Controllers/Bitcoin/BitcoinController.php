<?php

namespace App\Http\Controllers\Bitcoin;

use App\Http\Controllers\Controller;
use App\Repositories\HistoricBitcoinRepository;
use App\Services\Bitcoin\BitcoinService;

class BitcoinController extends Controller
{

    /**
     * @var BitcoinService
     */
    private $bitcoinService;

    /**
     * @var HistoricBitcoinRepository
     */
    private $historicBitcoinRepository;

    /**
     * Class constructor method.
     *
     * @param HistoricBitcoinRepository $historicBitcoinRepository
     * @param BitcoinService $bitcoinService
     *
     * @return void
     */
    public function __construct(
        BitcoinService            $bitcoinService,
        HistoricBitcoinRepository $historicBitcoinRepository
    ) {
        $this->bitcoinService            = $bitcoinService;
        $this->historicBitcoinRepository = $historicBitcoinRepository;
    }

    /**
     * Function get price bitcoin
     *
     * @return array
     */
    public function getPrice()
    {
        try {
            $data = $this->bitcoinService->getPrice();

            return apiResponse("Ok.", 200, $data);
        } catch (\Exception $e) {
            throw ($e);
        }
    }

    /**
     * Function get historic buy and sell bitcoin
     *
     * @return array
     */
    public function getHistoricBitcoinPrice()
    {
        try {

            $historic = $this->historicBitcoinRepository->getHistoricBitcoin();

            return apiResponse("Ok.", 200, $historic);
        } catch (\Exception $e) {
            throw ($e);
        }

    }

}
