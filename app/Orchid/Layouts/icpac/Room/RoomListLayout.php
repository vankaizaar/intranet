<?php

namespace App\Orchid\Layouts\icpac\Room;

use App\Room;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class RoomListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'rooms';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        
        return [           
            TD::set('room_name', 'Title')
            ->link('icpac.room.edit', 'id', 'room_name')
            ->width('150')
            ->align('center'), 
            TD::set('room_description', 'Description'),           
        ];
    }
}
