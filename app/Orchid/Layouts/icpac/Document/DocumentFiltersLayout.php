<?php

namespace App\Orchid\Layouts\icpac\Document;

use Orchid\Platform\Filters\Filter;
use Orchid\Screen\Layouts\Selection;
use App\Orchid\Filters\icpac\Document\DocumentQueryFilter;


class DocumentFiltersLayout extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return [
            DocumentQueryFilter::class,
        ];
    }
}
