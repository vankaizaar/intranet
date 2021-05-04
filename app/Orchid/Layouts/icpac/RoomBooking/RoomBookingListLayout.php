<?php

namespace App\Orchid\Layouts\icpac\RoomBooking;

use App\RoomBooking;
use App\User;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RoomBookingListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'roombookings';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [

            TD::set('id', 'ID')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->sort()
                ->link('roombooking.edit', 'id'),
            TD::set('title', 'Event')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->width('150')
                ->align('center'),
            TD::set('description', 'Description')
                ->sort()
                ->width('150')
                ->align('center'),
            TD::set('room_id', 'Room')
                ->width('150')
                ->sort()
                ->align('center')
                ->render(function (RoomBooking $roomBooking) {
                    $title = e($roomBooking->room->room_name);
                    return "$title";
                }),
            TD::set('user_id', 'Person')
                ->width('150')
                ->sort()
                ->align('center')
                ->render(function (RoomBooking $roomBooking) {
                    $title = e($roomBooking->user->name);
                    return "$title";
                }),
            TD::set('attendees', 'Attending')
                ->width('150')
                ->sort()
                ->align('center')
                ->render(function (RoomBooking $roomBooking) {
                    $users = $roomBooking->attendees;
                    $finalUsers = '';
                    foreach ($users as $user) {
                        $person = User::find($user);
                        $name = $person->name;
                        $finalUsers .= $name . ', ';
                    }
                    return $finalUsers;
                }),

            TD::set('start_time', 'Start Time')
                ->width('150')
                ->sort()
                ->align('center')
                ->render(function (RoomBooking $roomBooking) {
                    $start = date_create($roomBooking->start_time);
                    $format = date_format($start, "(H:i) l, j F Y ");
                    return $format;
                }),

            TD::set('end_time', 'End Time')
                ->width('150')
                ->sort()
                ->align('center')
                ->render(function (RoomBooking $roomBooking) {
                    $end = date_create($roomBooking->end_time);
                    $format = date_format($end, "(H:i) l, j F Y ");
                    return $format;
                }),

        ];
    }
}
