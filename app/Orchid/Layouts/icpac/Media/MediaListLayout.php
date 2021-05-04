<?php

namespace App\Orchid\Layouts\icpac\Media;

use App\Media;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class MediaListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'medias';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [            
            TD::set('title', 'Title')->link('icpac.media.edit', 'id', 'title'),            
        ];
    }
}
