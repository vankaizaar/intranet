<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocument extends FormRequest
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
            'document.updater' => 'user id',
            'document.title' => 'document title',
            'document.document_category_id' => 'document category',
            'document.cover_image' => 'cover image',
            'document.attachment' => 'document file',
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
            'document.updater' => 'required',
            'document.title' => 'required|max:255',
            'document.document_category_id' => 'required',
            'document.cover_image' => 'required',
            'document.attachment' => 'required',
        ];
    }

}
