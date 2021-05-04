<?php

namespace App\Orchid\Screens\icpac\Room;
use App\Room;
use App\Orchid\Layouts\icpac\Room\RoomListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class RoomListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Blog room';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All blog rooms';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'rooms' => Room::paginate()
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
                ->href(route('icpac.room.create'))
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
            RoomListLayout::class
        ];
    }
}
