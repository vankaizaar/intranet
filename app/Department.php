<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;


class Department extends Model
{
    use AsSource;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',       
    ];

    /**
     * Get the users in a department
     */

     public function users(){
         return $this->hasMany(User::class);
     }
     
}
