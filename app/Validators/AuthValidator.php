<?php

namespace App\Validators;

class AuthValidator extends Validator
{
    public function validateRegisterUser(array $data)
    {
        $rules = [
            'name'             => 'required|string',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|min:8|string',
            'password_confirm' => 'required|same:password'
        ];

        return $this->validate($data, $rules);
    }

    public function validateLogin(array $data)
    {
        $rules = [
            'email'    => 'required|string',
            'password' => 'required|string'
        ];

        return $this->validate($data, $rules);
    }
}
