<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //dd($this);
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
            'event.event_title' => 'event title',
            'event.event_description' => 'event description',
            'event.event_start' => 'event start date',
            'event.event_end' => 'event end date',
            'event.attendees' => 'attendees',
            'event.attendees.*' => 'attendees',
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
            'event.event_title' => 'required|max:255',
            'event.event_description' => 'required',
            'event.event_start' => 'required|date',
            'event.event_end' => 'required|date|after:event.event_start',
            'event.attendees' => 'required|array|min:2',
            'event.attendees.*' => 'required|int|distinct',
        ];
    }
}
