<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class StateValidator.
 *
 * @package namespace App\Validators;
 */
class StateValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            "country_id" => "required|exists:countries,id",
            "name" => "required",
            "code" => "required|unique:states,code"
        ],
        ValidatorInterface::RULE_UPDATE => [
            "country_id" => "required|exists:countries,id",
            "name" => "required",
            "code" => "required"
        ],
    ];
}
