<?php

namespace App\Orchid\Filters\icpac\ProjectFile;

use Orchid\Screen\Field;
use Orchid\Filters\Filter;
use App\Projectfile;
use Orchid\Screen\Fields\Input;
use Illuminate\Database\Eloquent\Builder;

class ProjectFileQueryFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['title'];

    /**
     * @var bool
     */
    public $dashboard = false;

    /**
     * @return string
     */
    public function name(): string
    {
        return __('Search');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('projectfiles', $this->request->get('title'));
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return Input::make('title')  
            ->type('text')                      
            ->value($this->request->get('title'))
            ->placeholder('Search...')
            ->title('Search');
    }
}
