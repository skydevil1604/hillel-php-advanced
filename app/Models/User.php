<?php

namespace App\Models;

use Core\Model;
class User extends Model
{
    public string|null $email, $password, $token = null, $token_expired_at = null, $created_at;
}
