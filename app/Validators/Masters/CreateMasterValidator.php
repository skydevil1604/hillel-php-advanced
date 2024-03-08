<?php

namespace App\Validators\Masters;

use App\Validators\BaseValidator;

class CreateMasterValidator extends BaseValidator
{
    protected array $rules = [
        'name' => '/[\w\s\(\)\-]{2,}/i',
        'surname' => '/[\w\s\(\)\-]{2,}/i',
    ];

    protected array $errors = [
        'name' => 'Name should contain characters, numbers, and _-() symbols and has length more than 2 symbols',
        'surname' => 'Surname should contain characters, numbers, and _-() symbols and has length more than 2 symbols'
    ];

    public function validate(int $id = null, array $fields = []): bool
    {
        if (!parent::validate(fields: $fields)) {
            return false;
        }

        return true;
    }
}
