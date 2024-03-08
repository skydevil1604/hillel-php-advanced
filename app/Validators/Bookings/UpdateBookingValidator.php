<?php

namespace App\Validators\Bookings;

class UpdateBookingValidator extends CreateBookingValidator
{
    protected array $skip = ['user_id', 'updated_at'];
}