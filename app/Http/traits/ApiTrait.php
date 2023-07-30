<?php

namespace App\Http\traits;

trait ApiTrait
{
    public function SuccessMessage(string $message = "", int $code = 200)
    {
        return response()->json(
            [
                'message' => $message,
                'errors' => (object)[],
                'data' => (object)[],
            ],
            $code
        );
    }

    public function ErrorMessage(array $errors, string $message = "", int $code = 422)
    {
        return response()->json(
            [
                'message' => $message,
                'errors' => $errors,
                'data' => (object)[],
            ],
            $code
        );
    }

    public function Data(array $data, string $message = "", int $code = 200)
    {
        return response()->json(
            [
                'message' => $message,
                'errors' => (object)[],
                'data' => $data,
            ],
            $code
        );
    }
}
