<?php

namespace App\Orchid\Screens\icpac\Media;

use App\Orchid\Layouts\icpac\Media\MediaListLayout;
use App\Media;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class MediaListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Media';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Media Files';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'medias' => Media::paginate()
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
                ->href(route('icpac.media.create'))
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
            MediaListLayout::class
        ];
    }
}
