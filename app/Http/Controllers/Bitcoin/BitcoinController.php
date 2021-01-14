<?php

namespace App\Http\Controllers\Bitcoin;

use App\Http\Controllers\Controller;
use App\Services\Bitcoin\BitcoinService;

class BitcoinController extends Controller
{

    /**
     * @var BitcoinService
     */
    private $bitcoinService;

    /**
     * Class constructor method.
     *
     * @return void
     */
    public function __construct(
        BitcoinService $bitcoinService
    ) {
        $this->bitcoinService = $bitcoinService;
    }

    /**
     * Function get price bitcoin
     *
     * @return json
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

}
