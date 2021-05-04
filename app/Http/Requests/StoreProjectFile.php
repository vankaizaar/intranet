<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectFile extends FormRequest
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
            'projectfile.title' => 'document title',
            'projectfile.project_id' => 'project',
            'projectfile.cover_image' => 'document cover image',
            'projectfile.attachment' => 'document',
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
            'projectfile.title' => 'required|max:255',
            'projectfile.project_id' => 'required',
            'projectfile.cover_image' => 'required|max:255',
            'projectfile.attachment' => 'required',
        ];
    }
}
