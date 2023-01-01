<?php
declare(strict_types=1);

namespace App\Output;

/**
 * View
 *
 * @package App\Output
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 * @copyright Mahmoud Ramadan
 */
class View
{
    /**
     * load view html or json
     * @param string $type
     * @param array $data
     */
    public function load(string $type, array $data = [])
    {
        echo $this->initialize($type)->load($data);
        die;
    }

    /**
     * initialize new object from html or json class
     * @param string $type
     * @return OutputInterface
     */
    public function initialize(string $type): OutputInterface
    {
        if ($type == 'html') {
            return new HtmlOutput();
        }
        return new JsonOutput();
    }
}
