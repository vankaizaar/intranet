<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class MediaCategory extends Model
{
    use AsSource;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media_categories';

    /**
     * @var array
     */
    protected $fillable = [
        'name',               
        'description'        
    ];

    /**
     * Get the files
     */
    public function medias(){
        return $this->hasMany(Media::class);
    }

    
}
