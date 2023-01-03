<?php


namespace App\Output;

/**
 * ViewStrategy
 *
 * @package App\Output
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 * @copyright Mahmoud Ramadan
 */
class ViewStrategy
{
    public OutputInterface $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * load view data html,json, ...etc
     * @param array $data
     */
    public function load(array $data = []): void
    {
        echo $this->output->load($data);
        die;
    }
}
