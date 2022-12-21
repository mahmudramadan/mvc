<?php

namespace App\Models;

class SecurityModel
{

    public function filterData(array $data): array
    {
        $finalData = [];
        foreach ($data as $key => $value) {
            $finalData[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }
        return $finalData;
    }
}
