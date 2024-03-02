<?php

namespace App\Validators\Auth;

class AuthValidator extends Base
{
    const string DEFAULT_MESSAGE = "Email or password is incorrect";

    protected array $rules = [
        'email' => '/^[a-zA-Z0-9.!#$%&\'*+\/\?^_`{|}~-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i',
        'password' => '/[a-zA-Z0-9.!#$%&\'*+\/\?^_`{|}~-]{8,}/',
    ];

    protected array $errors = [
        'email' => self::DEFAULT_MESSAGE,
        'password' => self::DEFAULT_MESSAGE
    ];

    public function validate(int $id = null, array $fields = []): bool
    {
        if (!parent::validate($id, $fields)) {
            return false;
        }

        return $this->checkEmailOnExists($fields['email'], false, self::DEFAULT_MESSAGE);
    }
}