<?php

namespace App\Http\Requests\Employee;

use App\Models\Employee;
use App\Rules\SubordinationLevel;
use App\Rules\UniqueFormatPhone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:2',
                'max:256',
                Rule::unique('employees')->ignore($this->employee->id)
            ],
            'employment_date' => ['required', 'date_format:d/m/y', 'after_or_equal:01/01/01'],
            'phone_number' => [
                'required',
                'phone:UA',
                new UniqueFormatPhone(
                    'employees',
                    'UA',
                    'international',
                    $this->employee->id
                )
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('employees')->ignore($this->employee->id)
            ],
            'salary' => ['required', 'numeric', 'min:0', 'max:500000'],
            'head' => [
                'nullable',
                'exists:employees,name',
                new SubordinationLevel(Employee::MAXIMUM_SUBORDINATION_LEVEL)
            ],
            'photo' => ['nullable', 'mimes:jpeg,jpg,png', 'max:5000'],
            'position_id' => ['required', 'exists:positions,id']
        ];
    }

    public function messages()
    {
        return [
            'phone_number.phone' => 'Incorrect phone format'
        ];
    }
}
