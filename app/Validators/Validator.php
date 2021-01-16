<?php

namespace App\Validators;

use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Validator as IlluminateValidator;

/**
 * Base Validation class. All entity specific validation classes inherit
 * this class and can override any function for respective specific needs
 */
abstract class Validator
{

    public function validate(
        array $data,
        array $rules = [],
        array $custom_errors = []
    ) {
        if (empty($rules) && !empty($this->rules) && is_array($this->rules)) {
            $rules = $this->rules;
        }

        $validator = IlluminateValidator::make($data, $rules, $custom_errors);
        $validator->setAttributeNames(Lang::get('fields'));

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return true;
    }
}
