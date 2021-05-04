<?php

namespace App\Orchid\Screens\icpac\Project;

use App\Project;
use Orchid\Screen\Screen;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;

class ProjectPublicListScreen extends Screen
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
    public $description = 'List of all ICPAC Projectss';

    /**
     * Query data.
     *
     * @param Project $project
     *
     * @return array
     */
    public function query(Project $project ): array
    {

        return [
            'projects' => Project::where('archived', FALSE)
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
            /* Link::make('Create New Project')
            ->href(route('project.create'))
            ->class('btn btn-info')
            ->icon('icon-plus'), */
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
            //Layout::view('platform::partials.projectspublic'),
            //Layout::view('platform::test'),
        ];
    }
}
