<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserByAdmin extends FormRequest
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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user.name' => 'name',
            'user.email' => 'email',
            'user.telephone' => 'telephone',
            'user.position_id' => 'position',
            'user.department_id' => 'department',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user.name' => 'required|max:255',
            'user.email' => 'required|email|max:255',
            'user.telephone' => 'required',
            'user.position_id' => 'required',
            'user.department_id' => 'required',
        ];
    }
}
