<?php
declare(strict_types=1);

namespace App\Validation;

use App\Controllers\ResponseMessage;

/**
 * FormValidation
 *
 * @package App\Validation
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
final class FormValidation
{
    use ResponseMessage;

    /**
     * data that will be validated
     * @var array
     */
    private array $data;

    /**
     * errors
     * @var array
     */
    private array $errors = [];

    /**
     * validate all data with rules
     * @param array $rules
     * @param array $data
     * @return bool
     */
    public function validate(array $rules, array $data): bool
    {
        $this->data = $data;
        foreach ($rules as $name => $rule) {
            foreach ($rule as $item) {
                $ruleValues = explode(":", $item);
                $ruleName = $ruleValues[0];
                $value = count($ruleValues) > 1 ? $ruleValues[1] : null;
                $this->$ruleName($name, $value);
            }
        }
        return !(count($this->errors) > 0);
    }

    /**
     * get errors of validation
     * @return string
     */
    public function getErrors(): string
    {
        return implode("<br>", $this->errors);
    }

    /**
     * check that field is found with data
     * @param $name
     * @param $value
     */
    private function required($name, $value): void
    {
        if (!isset($this->data[$name]) || trim($this->data[$name]) == "" || $this->data[$name] == null) {
            $this->errors[] = "$name is required";
        }
    }

    /**
     * check minimum input value length
     * @param $name
     * @param $value
     */
    private function min($name, $value): void
    {
        if (strlen($this->data[$name]) < $value) {
            $this->errors[] = "$name min characters should be $value";
        }
    }

    /**
     * check maximum input value length
     * @param $name
     * @param $value
     */
    private function max($name, $value): void
    {
        if (strlen($this->data[$name]) > $value) {
            $this->errors[] = "$name max characters should be $value";
        }
    }

    /**
     * check input value is greater than or equal value
     * @param $name
     * @param $value
     */
    private function gte($name, $value): void
    {
        if ($this->data[$name] < $value) {
            $this->errors[] = "$name should be greater than or equal $value";
        }
    }

    /**
     * check input value is valid email
     * @param $name
     * @param $value
     */
    private function email($name, $value): void
    {
        if (!filter_var($this->data[$name], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "$name should be an email";
        }
    }
}
