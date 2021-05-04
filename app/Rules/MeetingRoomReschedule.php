<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MeetingRoomReschedule implements Rule
{
    private $roomID;
    private $meetingStart;
    private $meetingEnd;
    private $currentBooking;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($meetingRoomID, $meetingStartTime, $meetingEndTime, $currentBookingID)
    {
        $this->roomID = $meetingRoomID;
        $this->meetingStart = $meetingStartTime;
        $this->meetingEnd = $meetingEndTime;
        $this->currentBooking = $currentBookingID;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $bookings = count(DB::select(DB::raw("SELECT * FROM room_bookings WHERE
                    (room_id = '$this->roomID' AND id != '$this->currentBooking' ) AND
                    (start_time BETWEEN '$this->meetingStart' AND '$this->meetingEnd)' OR
                    (end_time BETWEEN '$this->meetingStart' AND '$this->meetingEnd') OR
                    ('$this->meetingStart' BETWEEN start_time AND end_time))")));
        return (($bookings) > 0) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your rescheduling collides with another meeting on the meeting room';
    }
}
