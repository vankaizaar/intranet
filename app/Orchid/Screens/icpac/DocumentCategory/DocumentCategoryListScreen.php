<?php

namespace App\Orchid\Screens\icpac\DocumentCategory;

use App\Orchid\Layouts\icpac\DocumentCategory\DocumentCategoryListLayout;
use App\DocumentCategory;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class DocumentCategoryListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Document Categories';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Document Categories';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'documentcategories' => DocumentCategory::paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('icon-pencil')
                ->href(route('icpac.documentcategory.create'))
                ->class('btn btn-warning p-1')
                ->icon('icon-plus')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            DocumentCategoryListLayout::class
        ];
    }
}
