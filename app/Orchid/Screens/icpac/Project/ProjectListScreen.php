<?php

namespace App\Orchid\Screens\icpac\Project;

use App\Orchid\Layouts\icpac\Project\ProjectListLayout;
use App\Project;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ProjectListScreen extends Screen
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
    public $description = 'All ICPAC projects';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'projects' => Project::where('archived', FALSE)->paginate()
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
                ->icon('icon-pencil')
                ->href(route('icpac.project.create'))
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
            ProjectListLayout::class
        ];
    }
}
