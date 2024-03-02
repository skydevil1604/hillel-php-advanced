<?php

namespace App\Validators\Bookings;

use App\Models\Booking;
use App\Validators\BaseValidator;
use function Core\authId;

class UpdateBookingValidator extends CreateBookingValidator
{
    protected array $skip = ['user_id', 'updated_at'];
}