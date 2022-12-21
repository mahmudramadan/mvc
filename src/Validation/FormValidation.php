<?php

namespace App\Validation;

final class FormValidation
{
    private array $data;
    private array $rules;
    public array $errors = [];

    public function apply(array $rules, array $data)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate(): bool
    {
        foreach ($this->rules as $name => $rules) {
            foreach ($rules as $rule) {
                $ruleValues = explode(":", $rule);
                $ruleName = $ruleValues[0];
                $value = count($ruleValues) > 1 ? $ruleValues[1] : null;
                $this->$ruleName($name, $value);
            }
        }
        return !(count($this->errors) > 0);
    }

    public function getErrors(): string
    {
        return implode("<br>", $this->errors);
    }

    private function required($name, $value)
    {
        if (!isset($this->data[$name]) || trim($this->data[$name]) == "" || $this->data[$name] == null) {
            $this->errors[] = "$name is required";
        }
    }

    private function min($name, $value)
    {
        if (strlen($this->data[$name]) < $value) {
            $this->errors[] = "$name min characters should be $value";
        }
    }

    private function max($name, $value)
    {
        if (strlen($this->data[$name]) > $value) {
            $this->errors[] = "$name max characters should be $value";
        }
    }

    private function gte($name, $value)
    {
        if ($this->data[$name] < $value) {
            $this->errors[] = "$name should be greater than or equal $value";
        }
    }

    private function email($name, $value)
    {
        if (!filter_var($this->data[$name], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "$name should be an email";
        }
    }
}
