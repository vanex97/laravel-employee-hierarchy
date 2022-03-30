<?php

namespace App\Http\Requests\Employee;

use App\Models\Employee;
use App\Rules\SubordinationLevel;
use Illuminate\Foundation\Http\FormRequest;

class ReEmploymentRequest extends FormRequest
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
            'reEmployments.*.head' => [
                'nullable',
                'exists:employees,name',
                new SubordinationLevel(Employee::MAXIMUM_SUBORDINATION_LEVEL)
            ]
        ];
    }

    public function messages()
    {
        return [
            'reEmployments.*.head.exists' => 'The selected head name is invalid.'
        ];
    }
}
