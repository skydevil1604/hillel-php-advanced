<?php
namespace Core;

use PDO;

function json_response(int $code = 200, array $data = []): string
{
    header_remove();
    http_response_code($code);
    header("Cache-Control: no-transform,public,max-age:300,s-maxage=900");
    header("Content-Type: application/json");

    $statuses = [
        200 => '200 OK',
        400 => '400 Bad Request',
        403 => '403 Forbidden',
        405 => '405 Method not allowed',
        422 => '422 Unprocessable Entity',
        500 => '500 Internal Server Error',
    ];

    header("Status: " . $statuses[$code]);

    return json_encode([
        'code' => $code,
        'status' => $statuses[$code],
        ...$data
    ]);
}

function requestBody(): array
{
    $data = [];

    $requestBody = file_get_contents('php://input');

    if (!empty($requestBody)) {
        $data = json_decode($requestBody, true);
    }

    return $data;
}

function db(): PDO
{
    return DB::connect();
}