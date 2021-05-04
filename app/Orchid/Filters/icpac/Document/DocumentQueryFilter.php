<?php

namespace App\Orchid\Filters\icpac\Document;

use Orchid\Screen\Field;
use Orchid\Filters\Filter;
use App\Document;
use Orchid\Screen\Fields\Input;
use Illuminate\Database\Eloquent\Builder;

class DocumentQueryFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [
        'title',        
    ];

    

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
        return $builder->where('documents', $this->request->get('title'));
    }

    /**
     * @return Field[]
     */
    public function display(): Field
    {
        return Input::make('title')  
            ->type('text')                      
            ->value($this->request->get('title'))
            ->placeholder('Search...')
            ->title('Search');
    }
}
