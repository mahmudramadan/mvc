<?php

namespace App\Traits;

trait JsonResponse
{
    /**
     * @param string $message
     */
    public function errorResponse(string $message)
    {
        echo json_encode(['success' => false, 'message' => $message]);
    }

    /**
     * @param string $message
     * @param array $data
     */
    public function successResponse(string $message, array $data = [])
    {
        echo json_encode(['success' => true, 'message' => $message, "data" => $data]);
    }

}
