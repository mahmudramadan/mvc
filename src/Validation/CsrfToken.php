<?php
declare(strict_types=1);

namespace App\Validation;

use App\Controllers\ResponseMessage;
use App\Output\JsonOutput;

/**
 * CsrfToken
 *
 * @package App\Validation
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
class CsrfToken
{
    use ResponseMessage;

    /**
     * allowed hosts
     * @var array|string[]
     */
    private array $allowedHosts = ["http://localhost"];
    /**
     * request host
     * @var string
     */
    private string $requestHost;
    /**
     * error message
     * @var string
     */
    private string $errorMessage = "";
    public JsonOutput $jsonOutput;

    public function __construct(JsonOutput $jsonOutput)
    {
        $this->jsonOutput = $jsonOutput;
        $this->setRequestUrl();
    }

    /**
     * check csrf token is correct
     */
    public function checkCsrf(): void
    {
        $correctCsrf = $this->check();
        if (!$correctCsrf) {
            echo $this->jsonOutput->load($this->errorMessage($this->getErrorMessage()));
            die;
        }
    }

    /**
     * set request host
     */
    private function setRequestUrl(): void
    {
        $this->requestHost = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
    }

    /**
     * check csrf token is valid if it is not valid set error message
     * @return bool
     */
    private function check(): bool
    {
        if (!in_array($this->requestHost, $this->allowedHosts)) {
            $this->errorMessage = "This site is not allowed";
            return false;
        }
        if (!isset($_SERVER['HTTP_TOKEN']) || empty($_SERVER['HTTP_TOKEN'])) {
            $this->errorMessage = "your browser couldn't create a secure cookie";
            return false;
        }
        if (!hash_equals($_SESSION['token'], $_SERVER['HTTP_TOKEN'])) {
            $this->errorMessage = "your secure csrf token is expired reload the page";
            return false;
        }
        return true;
    }

    /**
     * get error message
     * @return string
     */
    private function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
