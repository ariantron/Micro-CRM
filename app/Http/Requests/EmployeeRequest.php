<?php

namespace App\Http\Requests;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'=>'required|string|min:3|max:255',
            'last_name'=>'required|string|min:3|max:255',
            'company_id'=>'required|integer',
            'email'=>'email|max:255',
            'phone'=>'min:3|max:20'
        ];
    }
}
