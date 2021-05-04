<?php

namespace App\Orchid\Layouts\icpac\MediaCategory;

use App\MediaCategory;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class MediaCategoryListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'mediacategories';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [            
            TD::set('name', 'Name')
                ->render(function (MediaCategory $mediacategory) {
                    // Please use view('path')
                    $route = route('icpac.mediacategory.edit', $mediacategory);
                    $title = e($mediacategory->name);

                    return "<a href='{$route}'>{$title}</a>";
                })
                ->width('250')
                ->align('center'),
            TD::set('description', 'Description'),           
        ];
    }
}
