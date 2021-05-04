<?php

namespace App\Orchid\Screens\icpac\Projectfile;

use App\Projectfile;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen; 

class ProjectfileViewScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Projects';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'You are currently viewing a project file';

    /**
     * Query data.
     * 
     * @param Projectfile $projectfile
     * 
     *
     * @return array
     */
    public function query(Projectfile $projectfile ): array
    {                       
        return [            
            'projectfile' => $projectfile
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
            Layout::view('platform::partials.projectfile'),
            Layout::tabs([
                'Example Tab Table' => TableExample::class,
                'Example Tab Rows'  => RowExample::class,
            ]),
        ];
    }
}
