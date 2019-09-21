<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class CountryValidator.
 *
 * @package namespace App\Validators;
 */
class CountryValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'code' => 'required|unique:countries,code'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'code' => 'required'
        ],
    ];
}
