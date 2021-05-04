<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;


class Room extends Model
{
    use AsSource;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rooms';

    /**
     * @var array
     */
    protected $fillable = [
        'room_name',
        'room_description',
    ];

    /**
     * Get bookings
     */
    public function roomBooking(){
        return $this->hasMany(RoomBooking::class);
    }
}
