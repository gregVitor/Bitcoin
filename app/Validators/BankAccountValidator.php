<?php

namespace App\Validators;

class BankAccountValidator extends Validator
{

    /**
     * Function Validate create account deposit
     *
     * @param array $data
     *
     * @return bool
     */
    public function createAccountDeposit(array $data)
    {
        $rules = [
            'amount' => 'required|numeric|not_in:0|min:0'
        ];

        if (isset($data['amount']) && isset($data['units'])) {
            abort(400, "Requisição inválida");
        }

        return $this->validate($data, $rules);
    }
}
