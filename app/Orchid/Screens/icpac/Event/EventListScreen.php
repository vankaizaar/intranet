<?php

namespace App\Orchid\Screens\icpac\Event;

use App\Orchid\Layouts\icpac\Event\EventListLayout;
use Orchid\Screen\Actions\Link;
use App\Event;
use Orchid\Screen\Screen;

class EventListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Events Editor';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Edit scheduled events';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'events' => Event::paginate()
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
            Link::make('Create new event')
                ->icon('icon-pencil')
                ->href(route('icpac.event.create'))
                ->class('btn btn-warning p-1')
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
            EventListLayout::class
        ];
    }
}
