<?php

namespace App\Orchid\Screens\icpac\Event;

use App\Event;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class EventViewScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Event';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Viewing event';

    /**
     * Query data.
     * 
     * @param Event $event
     *
     * @return array
     */
    public function query(Event $event): array
    {        
                    
        return [
            'event' => $event,   
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
            Layout::view('platform::partials.event'),
        ];
    }
}
