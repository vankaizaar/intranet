<?php

namespace App\Orchid\Screens\icpac\Event;

use App\Event;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class EventsPageScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Events';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All upcoming events';

    /**
     * Query data.
     *
     * @param Event $event
     * @return array
     * 
     */
    public function query(Event $event): array
    {
        return [
            'events' => Event::all(),   
            'today' => date("Y-m-d"),
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
            Link::make('Edit an event')
                ->icon('icon-pencil')
                ->href(route('icpac.event.list'))
                ->class('btn btn-warning mr-2 p-1')
                ->icon('icon-plus'),

            Link::make('Create new event')
                ->icon('icon-pencil')
                ->href(route('icpac.event.create'))
                ->class('btn btn-info p-1')
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
            Layout::view('platform::partials.eventspublic'),
        ];
    }
}
