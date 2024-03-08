<?php

namespace App\Models;

use Core\Model;

class Booking extends Model
{
    public int $user_id, $master_id, $type, $status;
    public string $customer_name, $vehicle, $date_time, $comment, $created_at, $updated_at;
}
