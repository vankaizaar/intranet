<?php

namespace App\Orchid\Screens\icpac\MediaCategory;

use App\MediaCategory;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class MediaCategoryViewScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Medias';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Viewing medias';

    /**
     * Query data.
     * 
     * @param MediaCategory $mediacategory
     *
     * @return array
     */
    public function query(MediaCategory $mediacategory): array
    {        
                    
        return [
            'mediacategory' => $mediacategory,        
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
            Layout::view('platform::partials.mediacategory'),
        ];
    }
}
