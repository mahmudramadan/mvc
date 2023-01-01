<?php
declare(strict_types=1);

namespace App\Output;

/**
 * HtmlOutput
 *
 * @package App\Output
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 * @copyright Mahmoud Ramadan
 */
class HtmlOutput implements OutputInterface
{
    private array $data;

    /**
     * load html content
     * @param array $data
     * @return void
     */
    public function load(array $data = [])
    {
        $this->data = $data;
        require __DIR__ . "/../Views/main_layout.php";
    }
}
