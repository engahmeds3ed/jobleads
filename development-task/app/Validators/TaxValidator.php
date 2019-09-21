<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class TaxValidator.
 *
 * @package namespace App\Validators;
 */
class TaxValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'taxrate_id' => 'required|exists:taxrates,id',
            'county_id' => 'required|exists:counties,id',
            'amount' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'taxrate_id' => 'required|exists:taxrates,id',
            'county_id' => 'required|exists:counties,id',
            'amount' => 'required'
        ],
    ];
}
