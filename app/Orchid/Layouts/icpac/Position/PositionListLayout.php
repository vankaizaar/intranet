<?php

namespace App\Orchid\Layouts\icpac\Position;

use App\Position;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class PositionListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'positions';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::set('name', 'Title')
                ->render(function (Position $position) {
                    // Please use view('path')
                    $route = route('platform.systems.positions.edit', $position);
                    $name = e($position->name);

                    return "<a href='{$route}'>{$name}</a>";
                })
                ->width('250'),

            TD::set('created_at', 'Created'),
            TD::set('updated_at', 'Last edit'),
        ];
    }
}
