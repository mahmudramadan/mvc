<?php

namespace App\Validation;

class CsrfToken
{
    private array $allowedHosts = ["http://localhost"];
    private string $currentUrl;
    private string $errorMessage = "";

    public function __construct()
    {
        $this->setCurrentRequestUrl();
    }

    public function generate()
    {
        $_SESSION['token'] =  $_SESSION['token'] ?? bin2hex(random_bytes(32));
    }

    private function setCurrentRequestUrl()
    {
        $this->currentUrl = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
    }

    public function check(): bool
    {
        if (!in_array($this->currentUrl, $this->allowedHosts)) {
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
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

}
