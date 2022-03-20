<?php

namespace App\Http\Requests;

use App\Models\Employee;
use App\Rules\SubordinationLevel;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => 'required|min:2|max:256|unique:employees',
            'employment_date' => 'required|date_format:d/m/y',
            'phone_number' => 'required|phone:UA|unique:employees',
            'email' => 'required|email|unique:employees',
            'salary' => 'required|numeric|min:0|max:500000',
            'head' => [
                'required',
                'exists:employees,name',
                new SubordinationLevel(Employee::MAXIMUM_SUBORDINATION_LEVEL)
            ],
            'photo' => 'required|mimes:jpeg,jpg,png|required|max:5000',
            'position_id' => 'required|exists:positions,id'
        ];
    }

    public function messages()
    {
        return [
            'phone_number.phone' => 'Incorrect phone format'
        ];
    }
}
