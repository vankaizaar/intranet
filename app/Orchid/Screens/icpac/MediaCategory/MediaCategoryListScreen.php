<?php

namespace App\Orchid\Screens\icpac\MediaCategory;

use App\Orchid\Layouts\icpac\MediaCategory\MediaCategoryListLayout;
use App\MediaCategory;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class MediaCategoryListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Media Categories';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Media Categories';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'mediacategories' => MediaCategory::paginate()
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
                ->href(route('icpac.mediacategory.create'))
                ->class('btn btn-warning')
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
            MediaCategoryListLayout::class
        ];
    }
}
