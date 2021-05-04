<?php

namespace App\Orchid\Screens\icpac\Position;

use App\Orchid\Layouts\icpac\Position\PositionListLayout;
use App\Position;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PositionListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Positions';

    /**
     * @var string
     */
    public $permission = 'platform.systems.positions';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Staff Positions';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'positions' => Position::paginate()
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
                ->class('btn btn-info p-1')
                ->href(route('platform.systems.positions.create'))
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
            PositionListLayout::class
        ];
    }
}
