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
class ViewFactory
{
    /**
     * initialize new object from html or json class
     * @param string $type
     * @return OutputInterface
     */
    public static function initialize(string $type): OutputInterface
    {
        if ($type == 'html') {
            return new HtmlOutput();
        }
        return new JsonOutput();
    }
}
