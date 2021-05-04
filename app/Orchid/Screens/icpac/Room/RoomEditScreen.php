<?php

namespace App\Orchid\Screens\icpac\Room;

use App\Room;
use App\Http\Requests\StoreRoom;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Support\Facades\Alert;


class RoomEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create a New Meeting Room';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'You are currently creating a meeting room';


    /**
     * @var bool
     */
    public $exists = false;

    /**
     * @var string
     */
    public $permission = 'edit_meeting_rooms';


    /**
     * Query data.
     *
     * @param Room $room
     *
     * @return array
     */
    public function query(Room $room): array
    {
        $this->exists = $room->exists;

        if ($this->exists) {
            $this->name = 'Edit a Meeting Room';
            $this->description = 'You are currently editing a meeting room';
        }

        return [
            'room' => $room
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
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('icon-note')
                ->class('btn btn-success mr-2')
                ->method('createOrUpdate')
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
                Input::make('room.room_name')
                    ->title('Meeting Room Name')
                    ->maxlength(255)
                    ->placeholder('Room name'),

                Quill::make('room.room_description')
                    ->title('Room Description')
                    ->placeholder('Brief description for the meeting room'),

            ])
        ];
    }

    /**
     * @param Room $room
     * @param StoreRoom $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Room $room, StoreRoom $request)
    {
        $room->fill($request->get('room'))->save();

        Alert::info('You have successfully created a room');

        return redirect()->route('room.list');
    }

    /**
     * @param Room $room
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Room $room)
    {
        $room->delete()
            ? Alert::info('You have successfully deleted the room.')
            : Alert::warning('An error has occurred');

        return redirect()->route('room.list');
    }
}
