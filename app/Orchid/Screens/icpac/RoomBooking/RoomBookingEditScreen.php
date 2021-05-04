<?php

namespace App\Orchid\Screens\icpac\RoomBooking;

use App\Notifications\DeletedRoomBooking;
use App\Notifications\RemovedUserRoomBooking;
use App\Room;
use App\RoomBooking;
use App\User;
use App\Http\Requests\StoreRoomBooking;
use App\Http\Requests\StoreRoomReschedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\DateTimer;
use App\Notifications\NewRoomBooking;
use App\Notifications\EditedRoomBooking;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class RoomBookingEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create a Room Booking';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'You are currently creating a room booking';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * @var string
     */
    public $permission = 'edit_meeting_rooms_bookings';

    /**
     * Query data.
     *
     * @param RoomBooking $roombooking
     *
     * @return array
     */
    public function query(RoomBooking $roombooking): array
    {
        $this->exists = $roombooking->exists;

        if ($this->exists) {
            $this->name = 'Edit a Room Booking';
            $this->description = 'You are currently editing a room booking';
        }
        return [
            'roombooking' => $roombooking,
        ];
    }

    /**
     * Button commands.
     *
     * @return Button[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Save')
                ->icon('icon-save')
                ->class('btn btn-success')
                ->method('create')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('icon-note')
                ->class('btn btn-success mr-2')
                ->method('update')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('icon-trash')
                ->class('btn btn-danger')
                ->method('remove')
                ->canSee($this->exists),
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
            Layout::rows([
                Input::make('roombooking.title')
                    ->title('Name of the meeting')
                    ->max(255)
                    ->placeholder('Title of meeting'),

                TextArea::make('roombooking.description')
                    ->title('Description')
                    ->max(255)
                    ->placeholder('Brief description about the meeting'),

                Select::make('roombooking.room_id')
                    ->fromModel(Room::class, 'room_name')
                    ->title('Meeting Room'),

                Input::make('roombooking.user_id')
                    ->type('hidden')->value(function () {
                        return Auth::id();
                    }),

                Select::make('roombooking.attendees.')
                    ->fromModel(User::class, 'name')
                    ->multiple()
                    ->title('Select Attendees'),

                DateTimer::make('roombooking.start_time')
                    ->title('From')
                    ->enableTime()
                    ->format24hr(),

                DateTimer::make('roombooking.end_time')
                    ->title('To')
                    ->enableTime()
                    ->format24hr(),
            ]),
        ];
    }

    /**
     * @param RoomBooking $roombooking
     * @param StoreRoomBooking $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(RoomBooking $roombooking, StoreRoomBooking $request)
    {

        $meetingMaster = User::where('id', $request->input('roombooking.user_id'))->get();
        $meetingAttendees = User::whereIn('id', $request->input('roombooking.attendees'))->get();

        if (!$roombooking->exists) {

            $roombooking->fill($request->get('roombooking'))->save();

            Notification::send($meetingAttendees, new NewRoomBooking($meetingAttendees, $meetingMaster, $roombooking));

            Alert::info('You have successfully booked the room');

            Log::info('Meeting ' . $roombooking->id . ' created by user: ' . auth()->user()->id);

            return redirect()->route('room.list');
        }
    }

    /**
     * @param RoomBooking $roombooking
     * @param StoreRoomReschedule $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoomBooking $roombooking, StoreRoomReschedule $request)
    {

        $meetingAttendees = User::whereIn('id', $request->input('roombooking.attendees'))->get();

        $removedUsersArray = array_diff($roombooking->attendees, $request->input('roombooking.attendees'));

        $removedUsers = User::whereIn('id', $removedUsersArray)->get();

        Notification::send($removedUsers, new RemovedUserRoomBooking($roombooking, $meetingAttendees));

        $roombooking->fill($request->get('roombooking'))->save();

        Notification::send($meetingAttendees, new EditedRoomBooking($roombooking));

        Log::info('Meeting ' . $roombooking->id . ' updated by user: ' . auth()->user()->id);

        Alert::info('You have successfully updated your room booking');

        return redirect()->route('room.list');

    }

    /**
     * @param RoomBooking $roombooking
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public
    function remove(RoomBooking $roombooking)
    {
        $attendingUsersArray = $roombooking->attendees;

        $attendingUsers = User::whereIn('id', $attendingUsersArray)->get();

        Notification::send($attendingUsers, new DeletedRoomBooking($roombooking, $attendingUsers));

        $roombooking->delete()
            ? Alert::info('You have successfully deleted the room booking and meeting')
            : Alert::warning('An error has occurred');

        Log::info('Meeting ' . $roombooking->id . ' deleted by user: ' . auth()->user()->id);

        return redirect()->route('room.list');
    }

}
