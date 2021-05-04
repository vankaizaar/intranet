<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class DocumentCategory extends Model
{
    use AsSource;
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'document_categories';

     /**
     * @var array
     */
    protected $fillable = [
        'name',               
        'description',
        'image'       
    ];

    /**
     * Get the files
     */
    public function documents(){
        return $this->hasMany(Document::class);
    }
}
