<?php
declare(strict_types=1);

namespace App\Controllers;

/**
 * ResponseMessage
 *
 * @package App\Controllers
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
trait ResponseMessage
{
    /**
     * create error messages
     * @param string $message
     * @return array
     */
    public function errorMessage(string $message): array
    {
        return ['success' => false, 'message' => $message];
    }

    /**
     * create success message with data
     * @param string $message
     * @param array $data
     * @return array
     */
    public function successMessage(string $message, array $data = []): array
    {
        return ['success' => true, 'message' => $message, "data" => $data];
    }
}
