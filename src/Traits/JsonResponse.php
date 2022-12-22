<?php

namespace App\Traits;

trait JsonResponse
{

    /**
     * @param string $message
     * @return string
     */
    public function errorResponse(string $message): string
    {
        return json_encode(['success' => false, 'message' => $message]);
    }

    /**
     * @param string $message
     * @param array $data
     * @return string
     */
    public function successResponse(string $message, array $data = []): string
    {
        return json_encode(['success' => true, 'message' => $message, "data" => $data]);
    }

}
