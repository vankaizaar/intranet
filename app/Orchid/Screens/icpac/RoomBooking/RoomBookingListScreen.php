<?php

namespace App\Orchid\Screens\icpac\RoomBooking;

use App\Orchid\Layouts\icpac\RoomBooking\RoomBookingListLayout;
use App\RoomBooking;
use App\User;
use Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class RoomBookingListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Room Bookings';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'A listing of all room bookings';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $roombookings = User::find(Auth::user()->id)->roomBooking;
        
        return [
            'roombookings' => $roombookings
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
                ->class('btn btn-info')
                ->href(route('roombooking.create'))                
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
            RoomBookingListLayout::class
        ];
    }
}
