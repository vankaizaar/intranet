<?php

namespace App\Http\Requests;

use App\Rules\MeetingRoomReschedule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoomReschedule extends FormRequest
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
            'roombooking.title' => 'meeting title',
            'roombooking.description' => 'meeting description',
            'roombooking.room_id' => 'meeting room',
            'roombooking.user_id' => 'id',
            'roombooking.start_time' => 'meeting start time',
            'roombooking.end_time' => 'meeting end time',
            'roombooking.attendees' => 'attendees',
            'roombooking.attendees.*' => 'attendees',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currentBookingID = $this->route('roombookings');
        $meetingRoomID = $this->input('roombooking.room_id');
        $meetingStartTime = $this->input('roombooking.start_time');
        $meetingEndTime = $this->input('roombooking.end_time');
        $meetingStartEarliest = Carbon::now()->addMinute(30);
        return [
            'roombooking.title' => 'required|max:255',
            'roombooking.description' => 'required|max:255|min:10',
            'roombooking.room_id' => ['required', new MeetingRoomReschedule($meetingRoomID,$meetingStartTime,$meetingEndTime,$currentBookingID)],
            'roombooking.user_id' => 'required',
            'roombooking.start_time' => 'required|date|after:' . $meetingStartEarliest,
            'roombooking.end_time' => 'required|date|after:roombooking.start_time',
            'roombooking.attendees' => 'required|array|min:2',
            'roombooking.attendees.*' => 'required|int|distinct',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'roombooking.start_time.after' => 'Rescheduling must be done at least 30 minutes from the current time.',
        ];
    }
}
