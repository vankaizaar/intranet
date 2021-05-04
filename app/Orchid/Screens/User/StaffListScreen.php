<?php

namespace App\Orchid\Screens\User;

use App\User;
use Orchid\Screen\Screen;
use Orchid\Screen\Layout;
use App\Orchid\Layouts\User\StaffListLayout;

class StaffListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Staff Directory';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'ICPAC Staff';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'users'=> User::filters()->defaultSort('id')->paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
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
            Layout::tabs([                  
                '<i class="icon-grid"></i>' => Layout::view('platform::partials.staffgrid'),                                               
                '<i class="icon-list"></i>' => StaffListLayout::class,
            ]),
        ];
    }
}
