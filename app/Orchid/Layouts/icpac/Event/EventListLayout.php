<?php

namespace App\Orchid\Layouts\icpac\Event;

use App\Event;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class EventListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'events';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [            
            TD::set('event_title', 'Title')
                ->render(function (Event $event) {                    
                    $route = route('icpac.event.edit', $event);
                    $title = e($event->event_title);

                    return "<a href='{$route}'>{$title}</a>";
                }),
            TD::set('event_description', 'Event Description'),
            TD::set('event_start', 'Event Start'),
            TD::set('event_end', 'Event End'),
            
        ];
    }
}
