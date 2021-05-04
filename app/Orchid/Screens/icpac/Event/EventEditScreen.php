<?php

namespace App\Orchid\Screens\icpac\Event;

use App\Event;
use App\User;
use App\Http\Requests\StoreEvent;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class EventEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create a new event';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Calendar events';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * @var string
     */
    public $permission = 'edit_events';


    /**
     * Query data.
     *
     * @param Event $event
     *
     * @return array
     */
    public function query(Event $event): array
    {
        $this->exists = $event->exists;

        if($this->exists){
            $this->name = 'Edit event';
        }

        return [
            'event' => $event
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
                ->icon('icon-pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists)
                ->class('btn btn-success mr-2 p-1'),

            Button::make('Update')
                ->icon('icon-note')
                ->method('createOrUpdate')
                ->canSee($this->exists)
                ->class('btn btn-success mr-2 p-1'),

            Button::make('Remove')
                ->icon('icon-trash')
                ->method('remove')
                ->canSee($this->exists)
                ->class('btn btn-danger p-1'),
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
                Input::make('event.event_title')
                    ->title('Event Title')
                    ->placeholder('Enter title'),

                TextArea::make('event.event_description')
                    ->title('Event Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for event'),

                DateTimer::make('event.event_start')
                    ->title('Event Start Date')
                    ->enableTime()
                    ->format24hr(),

                DateTimer::make('event.event_end')
                    ->title('Event End Date')
                    ->enableTime()
                    ->format24hr(),

                Select::make('event.attendees.')
                    ->fromModel(User::class, 'name')
                    ->multiple()
                    ->vertical()
                    ->title('Select Attendees'),

            ])
        ];
    }

    /**
     * @param Event    $event
     * @param StoreEvent $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Event $event, StoreEvent $request)
    {
        $event->fill($request->get('event'))->save();

        Alert::info('Event saved');

        return redirect()->route('icpac.calendar.view');
    }

    /**
     * @param Event $event
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Event $event)
    {
        $event->delete()
            ? Alert::info('You have successfully deleted the event.')
            : Alert::warning('An error has occurred')
        ;

        return redirect()->route('icpac.calendar.view');
    }
}
