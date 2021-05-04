<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Screen\AsSource;

class RoomBooking extends Model
{
    use AsSource,Notifiable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'room_bookings';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'room_id',
        'user_id',
        'start_time',
        'end_time',
        'attendees'
    ];

    protected $dates = ['start_time', 'end_time'];

    /**
     * @var array
     */
    protected $casts = [
        'attendees'       => 'array',
        'start_time' => 'datetime',
        'end_time'        => 'datetime',
    ];

    /**
     * Get room
     */
    public function room(){
        return $this->belongsTo(Room::class);
    }

    /**
     * Get user
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
