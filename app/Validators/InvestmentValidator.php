<?php

namespace App\Validators;

class InvestmentValidator extends Validator
{

    /**
     * Function Validate create purchase
     *
     * @param array $data
     *
     * @return bool
     */
    public function createPurchase(array $data)
    {
        $rules = [
            'amount' => (!isset($data['units']) ? 'required|' : '') . '|numeric|not_in:0|min:0',
            'units'  => (!isset($data['amount']) ? 'required|' : '') . '|numeric|not_in:0|min:0'
        ];

        if (isset($data['amount']) && isset($data['units'])) {
            abort(400, "Requisição inválida");
        }

        return $this->validate($data, $rules);
    }
}
