<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Platform\Searchable;

class Document extends Model
{
    use Attachable, AsSource, Filterable,Searchable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attachment' => 'array'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'attachment',
        'cover_image',
        'document_category_id',
        'updater'
    ];

     /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'title',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'title',
        'document_category_id',
    ];

    /**
     *@throws Exception
     *
     * @return string
     */
    public function getCover() : string
    {
        return $this->cover_image;
    }

    /**
     * Get the category
     */
    public function DocumentCategory(){
        return $this->belongsTo(DocumentCategory::class);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id'=>$this->id,
            'title' => $this->title,
        ];
    }



}
