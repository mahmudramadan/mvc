<?php
declare(strict_types=1);

namespace App\Models;

/**
 * SecurityModel
 *
 * @package App\Models
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
class SecurityModel
{
    /**
     * filter all inputs
     * @param array $data
     * @return array
     */
    public function filterData(array $data): array
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            $finalData[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }
        return $finalData;
    }
}
