<?php

namespace App\Orchid\Screens\icpac\Project;

use App\Project;
use App\User;
use Auth;
use App\Projectfile;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use App\Orchid\Layouts\icpac\Projectfile\ProjectfilePublicListLayout;

class ProjectViewScreen extends Screen
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
    public $description = 'You are currently viewing a project';



    /**
     * Query data.
     *
     * @param Project $project
     *
     *
     *
     * @return array
     */
    public function query(Project $project): array
    {
        $this->projectID = $project->id;

        $userProjects = Auth::user()->projects;

        $allowPrivateProjectsView = in_array($this->projectID, $userProjects);

        if ($allowPrivateProjectsView) {
            $allowedProjectFiles = Projectfile::where('project_id', $project->id)->filters()->defaultSort('id')->paginate();
        } else {
            $allowedProjectFiles = Projectfile::where(['project_id' => $project->id, 'is_private' => '0'])->filters()->defaultSort('id')->paginate();
        }

        return [
            'project' => $project,
            'projectfiles' => $allowedProjectFiles
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
            Link::make('Edit Project')
                ->href(route('project.edit', $this->projectID))
                ->class('btn btn-warning mr-2 p-1')
                ->icon('icon-note'),

            Link::make('Add Files')
                ->href(route('projectfile.create'))
                ->class('btn btn-info mr-2 p-1')
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
            Layout::view('platform::partials.project'),
            Layout::tabs([
                '<i class="icon-grid"></i>' => Layout::view('platform::partials.projectfilegrid'),
                '<i class="icon-list"></i>' => ProjectfilePublicListLayout::class,
            ]),
        ];
    }
}
