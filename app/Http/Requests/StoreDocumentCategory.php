<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentCategory extends FormRequest
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
            'documentcategory.name' => 'category name',
            'documentcategory.description' => 'document category description',
            'documentcategory.image' => 'document category image',
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
            'documentcategory.name' => 'required|max:255',
            'documentcategory.description' => 'required',
            'documentcategory.image' => 'required|max:255',
        ];
    }
}
