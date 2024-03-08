<?php

namespace App\Controllers;

use App\Models\Master;
use App\Validators\Masters\CreateMasterValidator;
use App\Validators\Masters\UpdateMasterValidator;
use PDO;
use function Core\authId;
use function Core\db;
use function Core\requestBody;

class MastersController extends BaseApiController
{
    public function index(): array
    {
        Master::setTableName();

        $query = "SELECT * FROM " . Master::$tableName . " ORDER BY created_at ASC";
        $result = db()->query($query)->fetchAll(PDO::FETCH_CLASS, Master::class);

        return $this->response(
            body: $result
        );
    }

    public function show(int $id)
    {
        $booking = Master::find($id);

        if (!$booking) {
            return $this->response(404, errors: ['message' => 'Master not found']);
        }

        return $this->response(body: $booking->toArray());
    }

    public function store()
    {
        $data = requestBody();
        $validator = new CreateMasterValidator();

        if ($validator->validate(fields: $data) && $master = Master::create($data)) {
            return $this->response(body: $master->toArray());
        }

        return $this->response(422, errors: $validator->getErrors());
    }

    public function update(int $id)
    {
        $master = Master::find($id);

        if (!$master) {
            return $this->response(403, errors: [
                'message' => 'An error occurred while updating'
            ]);
        }

        $data = [
            ...requestBody(),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $validator = new UpdateMasterValidator();

        if ($validator->validate($id, $data) && $master = $master->update($data)) {
            return $this->response(body: $master->toArray());
        }

        return $this->response(422, errors: $validator->getErrors());
    }


    public function destroy($id)
    {
        $master = Master::find($id);

        if (!$master) {
            return $this->response(404, errors: ['message' => 'Master not found']);
        }

        $result = Master::destroy($id);

        if (!$result) {
            return $this->response(422, errors: ['message' => 'Oops, smth went wrong']);
        }

        return $this->response();
    }
}
