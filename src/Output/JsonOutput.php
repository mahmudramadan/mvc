<?php
declare(strict_types=1);

namespace App\Output;

/**
 * JsonOutput
 *
 * @package App\Output
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 * @copyright Mahmoud Ramadan
 */
class JsonOutput implements OutputInterface
{
    /**
     * load json encode of data
     * @param array $data
     * @return false|string
     */
    public function load(array $data = [])
    {
        return json_encode($data);
    }
}
