<?php

namespace App\Orchid\Screens\icpac\Media;

use App\Media;
use Orchid\Screen\Layout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

class MediaViewScreen extends Screen
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
    public $description = 'Viewing media';

    /**
     * Query data.
     * 
     * @param Media $media
     *
     * @return array
     */
    public function query(Media $media): array
    {
        return [
            'media' => $media
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::view('platform::partials.media'),
        ];
    }
}
