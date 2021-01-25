<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class RequestValidator.
 *
 * @package namespace App\Validators;
 */
class RequestValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'username' => 'required|string',
            'email' => 'required|string',
            'file' => 'required|string',
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
