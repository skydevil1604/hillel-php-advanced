<?php

namespace App\Controllers;

use App\Models\Booking;
use App\Validators\Bookings\CreateBookingValidator;
use App\Validators\Bookings\UpdateBookingValidator;
use PDO;
use function Core\authId;
use function Core\db;
use function Core\requestBody;

class BookingsController extends BaseApiController
{
    public function index(): array
    {
        Booking::setTableName();

        $user = authId();
        $query = "SELECT * FROM " . Booking::$tableName . " WHERE user_id = $user ORDER BY created_at ASC";
        $result = db()->query($query)->fetchAll(PDO::FETCH_CLASS, Booking::class);

        return $this->response(
            body: $result
        );
    }

    public function show(int $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return $this->response(404, errors: ['message' => 'Booking not found']);
        }

        return $this->response(body: $booking->toArray());
    }

    public function store()
    {
        $data = array_merge(
            requestBody(),
            ['user_id' => authId()]
        );
        $validator = new CreateBookingValidator();

        if ($validator->validate(fields: $data) && $booking = Booking::create($data)) {
            return $this->response(body: $booking->toArray());
        }

        return $this->response(422, errors: $validator->getErrors());
    }

    public function update(int $id)
    {
        $booking = Booking::find($id);

        if (!$booking || $booking->user_id !== authId()) {
            return $this->response(403, errors: [
                'message' => 'This resource is forbidden for you'
            ]);
        }

        $data = [
            ...requestBody(),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $validator = new UpdateBookingValidator();

        if ($validator->validate($id, $data) && $booking = $booking->update($data)) {
            return $this->response(body: $booking->toArray());
        }

        return $this->response(422, errors: $validator->getErrors());
    }


    public function destroy($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return $this->response(404, errors: ['message' => 'Resource not found']);
        }

        if ($booking->user_id !== authId()) {
            return $this->response(403, errors: ['message' => 'This resource is forbidden for you']);
        }

        $result = Booking::destroy($id);

        if (!$result) {
            return $this->response(422, errors: ['message' => 'Oops, smth went wrong']);
        }

        return $this->response();
    }
}
