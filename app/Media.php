<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;

class Media extends Model
{
    use Attachable;
    use AsSource;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medias';

    protected $casts = [
        'attachment' => 'array'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'title',               
        'attachment',
        'media_category_id'       
    ];
     

    /**
     * Get the user
     */
   /*  public function user(){
        return $this->belongsTo(User::class);
    } */

    /**
     * Get the category
     */
    public function mediacategory(){
        return $this->belongsTo(MediaCategory::class);
    }
}
