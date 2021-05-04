<?php

namespace App\Orchid\Layouts\icpac\DocumentCategory;

use App\DocumentCategory;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class DocumentCategoryListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'documentcategories';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [            
            TD::set('name', 'Name')
                ->render(function (DocumentCategory $documentcategory) {
                    // Please use view('path')
                    $route = route('icpac.documentcategory.edit', $documentcategory);
                    $title = e($documentcategory->name);

                    return "<a href='{$route}'>{$title}</a>";
                })
                ->width('250')
                ->align('center'),
            TD::set('description', 'Description'),           
        ];
    }
}
