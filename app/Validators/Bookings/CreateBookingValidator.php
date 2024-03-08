<?php

namespace App\Validators\Bookings;

use App\Models\Booking;
use App\Validators\BaseValidator;
use PDO;
use function Core\db;

class CreateBookingValidator extends BaseValidator
{
    protected array $rules = [
        'customer_name' => '/[\w\s\(\)\-]{2,}/i',
        'vehicle' => '/[\w\s\(\)\-]{3,}/i',
    ];

    protected array $errors = [
        'customer_name' => 'Name should contain characters, numbers, and _-() symbols and has length more than 3 symbols',
        'vehicle' => 'Vehicle should contain characters, numbers, and _-() symbols and has length more than 3 symbols'
    ];

    protected array $skip = ['user_id'];

    public function validate(int $id = null, array $fields = []): bool
    {
        if (!parent::validate(fields: $fields)) {
            return false;
        }

        return $this->checkOnDuplicateDateTime($fields['date_time'], $id);
    }

    protected function checkOnDuplicateDateTime(string $date_time, int $id = null): bool
    {
        Booking::setTableName();

        if ($id) {
            $query = "SELECT * FROM " . Booking::$tableName . " WHERE date_time = '$date_time' AND id != $id";
        } else {
            $query = "SELECT * FROM " . Booking::$tableName . " WHERE date_time = '$date_time'";
        }
        $result = empty(db()->query($query)->fetchAll(PDO::FETCH_CLASS, Booking::class));

        if(!$result) {
            $this->setError('date_time', 'The booking with the date/time already exists');
        }

        return $result;
    }
}