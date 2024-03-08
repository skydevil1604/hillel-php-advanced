<?php

namespace App\Models;

use Core\Model;

class Master extends Model
{
    public int $level;
    public string $name, $surname, $created_at, $updated_at;
}
