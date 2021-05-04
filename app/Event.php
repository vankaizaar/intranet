<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Event extends Model
{
    use AsSource;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'events';

    protected $casts = [
        'attendees' => 'array',        
    ];

    protected $dates = ['event_start','event_end'];

    /**
     * @var array
     */
    protected $fillable = [
        'event_title',               
        'event_start',        
        'event_end',               
        'event_description',
        'attendees'                   
    ];
 
}
