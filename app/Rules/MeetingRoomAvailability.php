<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MeetingRoomAvailability implements Rule
{
    private $roomID;
    private $meetingStart;
    private $meetingEnd;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($meetingRoomID, $meetingStartTime,$meetingEndTime)
    {
        $this->roomID = $meetingRoomID;
        $this->meetingStart = $meetingStartTime;
        $this->meetingEnd = $meetingEndTime;
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
        $bookings = count(DB::select("SELECT * FROM room_bookings WHERE ((start_time BETWEEN '$this->meetingStart' AND '$this->meetingEnd') OR (end_time BETWEEN '$this->meetingStart' AND '$this->meetingEnd') OR ('$this->meetingStart' BETWEEN start_time AND end_time)) AND (room_id = '$this->roomID')"));
        return (($bookings) > 0) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is already booked for the suggested time.';
    }
}
