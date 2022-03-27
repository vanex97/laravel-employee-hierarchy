<?php

namespace App\Rules;

use App\Models\Employee;
use Illuminate\Contracts\Validation\Rule;

class UniqueFormatPhone implements Rule
{
    /**
     * The table to run the query against.
     * @var string
     */
    public string $table;

    /**
     * Phone county code.
     * @var array|string
     */
    private $county;

    /**
     * Number format.
     * @var string|null
     */
    private ?string $format;

    /**
     * The ID that should be ignored.
     * @var int|null
     */
    protected ?int $ignoredId;

    /**
     * Create a new rule instance.
     * @param string       $table
     * @param string|array $country
     * @param string|null  $format
     * @param int|null     $ignoredId
     */
    public function __construct($table, $country = [], $format = null, $ignoredId = null)
    {
        $this->table = $table;
        $this->county = $country;
        $this->format = $format;
        $this->ignoredId = $ignoredId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        try {
            $formattedPhone = phone($value, $this->county, $this->format);
            $employee = Employee::where('phone_number', $formattedPhone)->first();
            return $employee === null || $employee->id === $this->ignoredId;
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The phone has already been taken.';
    }
}
