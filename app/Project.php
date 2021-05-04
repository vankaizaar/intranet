<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use AsSource;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'archived',
        'image'
    ];


    /**
     * Get the users for a given project.
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }


    /**
     * Get the Projectfiles for a given project.
     */
    public function Projectfiles()
    {
        return $this->hasMany(Projectfile::class);
    }


    public function scopeArchived(Builder $query)
    {
        return $query->where('archived', false);
    }
}
