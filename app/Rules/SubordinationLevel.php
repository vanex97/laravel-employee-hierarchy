<?php

namespace App\Rules;

use App\Models\Employee;
use Illuminate\Contracts\Validation\Rule;

class SubordinationLevel implements Rule
{
    private $maxValue;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($maxValue)
    {
        $this->maxValue = $maxValue;
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
        $employee = Employee::withDepth()->where('name', $value)->first();
        if($employee === null) {
            return false;
        }
        return $employee->depth < $this->maxValue - 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This worker cannot have subordinates.';
    }
}
