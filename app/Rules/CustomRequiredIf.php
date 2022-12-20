<?php

namespace App\Rules;

use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class CustomRequiredIf implements Rule, DataAwareRule
{
    protected $data;
    protected $anotherField, $val, $attributeName;
    /**
     * Checks if the value of another validation key exists
     *
     * @param string $anotherField Attribute to check.
     * @param string $val Value to use for the evaluation.
     * @param string $attribute
     * @return void
     */
    public function __construct(string $anotherField, string $val, string $attributeName)
    {
        $this->anotherField = $anotherField;
        $this->val = $val;
        $this->attributeName = $attributeName;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        Log::info('another field: ' . $this->anotherField);
        Log::info($this->data['cards']);
        return $this->data['cards'][0][$this->anotherField] == $this->val && !empty($value);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The $this->attributeName is required.";
    }


    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
