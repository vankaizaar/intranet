<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;

class Projectfile extends Model
{
    use Attachable, AsSource, Filterable ;

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projectfiles';


    protected $casts = [
        'attachment' => 'array',
        'is_private' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'attachment',
        'is_private',
        'project_id',
        'cover_image',
        'updater'
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'title',
        'project_id',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'title',
        'project_id',
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
     * Get the project
     */
    public function project(){
        return $this->belongsTo(Project::class);
    }

}
