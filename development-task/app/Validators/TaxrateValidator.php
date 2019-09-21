<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class TaxrateValidator.
 *
 * @package namespace App\Validators;
 */
class TaxrateValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'amount' => 'required',
            'code' => 'required|unique:taxrates,code'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'amount' => 'required',
            'code' => 'required'
        ],
    ];
}
