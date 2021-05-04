<?php

namespace App\Orchid\Screens\icpac\RoomBooking;

use App\RoomBooking;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen; 

class RoomBookingViewScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Room Booking';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Viewing room booking';

    /**
     * Query data.
     * 
     * @param RoomBooking $roombooking
     * 
     *
     * @return array
     */
    public function query(RoomBooking $roombooking): array
    {                       
        return [            
            'roombooking' => $roombooking
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
            Layout::view('platform::partials.roombooking'),
        ];
    }
}
