<?php

namespace App\Services\Bitcoin;

class BitcoinService
{

    /**
     * Get values by integration api
     *
     * @return object
     */
    public function getPrice()
    {
        $response = curRequest('https://www.mercadobitcoin.net/api/BTC/ticker/', 'GET');
        if (empty($response)) {
            abort(500, "Erro ao requisitar valor de mercado");
        }
        $data = json_decode($response);

        return (object) [
            'buy'  => (float) $data->ticker->buy,
            'sell' => (float) $data->ticker->sell,
            'date' => date('Y-m-d H:i', ($data->ticker->date))
        ];
    }
}
