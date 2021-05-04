<?php

namespace App\Orchid\Screens\icpac\DocumentCategory;

use App\DocumentCategory;
use Orchid\Screen\Screen;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;

class DocumentCategoryPublicListScreen extends Screen
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
    public $description = 'List of document categories';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'documentcategories' => DocumentCategory::all()
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create New Document Category')
            ->href(route('documentcategory.create'))
            ->class('btn btn-info btn-block p-1')
            ->icon('icon-plus'),
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
            Layout::view('platform::partials.documentcategoryspublic'),
        ];
    }
}
