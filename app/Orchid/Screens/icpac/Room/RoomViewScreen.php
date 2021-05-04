<?php

namespace App\Orchid\Screens\icpac\Room;

use App\Orchid\Layouts\icpac\RoomBooking\RoomBookingPublicListLayout;
use App\Room;
use App\RoomBooking;
use Orchid\Presets\Orchid;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Carbon\Carbon;

class RoomViewScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Room';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'You are currently viewing a meeting room';

    /**
     * Query data.
     *
     * @param Room $room
     *
     *
     * @return array
     */
    public function query(Room $room): array
    {
        $now = Carbon::now()->toDateTimeString();        
        $this->RoomID = $room->id;
        $roombookings = $room->roombooking()->where('end_time','>', $now )->get();
        return [
            'room' => $room,
            'roombookings' => $roombookings,
            'today' => date("Y-m-d"),
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
            Link::make('Edit Meeting Room')
                ->href(route('room.edit', $this->RoomID))
                ->class('btn btn-warning mr-2')
                ->icon('icon-note'),            

            Link::make('Make a Booking')
                ->href(route('roombooking.create'))
                ->icon('icon-plus')
                ->class('btn btn-info mr-2'),

            Link::make('Edit Your Bookings')
                ->href(route('roombooking.list'))
                ->class('btn btn-default mr-2')
                ->icon('icon-note'),
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
            Layout::view('platform::partials.room'),
            Layout::tabs([
                '<i class="icon-grid"></i>' => Layout::view('platform::partials.roombookingpublic'),
                //'<i class="icon-list"></i>' => RoomBookingPublicListLayout::class,
            ]),
        ];
    }
}
