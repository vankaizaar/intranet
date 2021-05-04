<?php

namespace App\Orchid\Screens\icpac\Room;

use App\Room;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Carbon\Carbon;

class RoomPublicListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Rooms';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'List of ammenities that can be booked';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {        
        return [
            'rooms' => Room::all(),
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
            Link::make('Create New Meeting Room')
                ->class('btn btn-block btn-info')
                ->href(route('room.create'))
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
            Layout::view('platform::partials.roomspublic'),
        ];
    }
}
