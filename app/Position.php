<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Position extends Model
{
    use AsSource;

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];
    /**
     * Get the users in a position
     */

    public function users(){
        return $this->hasMany(User::class);
    }
}
