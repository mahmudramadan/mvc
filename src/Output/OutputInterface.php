<?php
declare(strict_types = 1);

namespace App\Output;

/**
 * OutputInterface
 *
 * @package App\Output
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 * @copyright Mahmoud Ramadan
 */
interface OutputInterface
{
    /*
     * load view html or json, ...etc
     */
    public function load(array $data = []);
}
