<?php

namespace App\Orchid\Screens\icpac\Project;

use App\Project;
use App\Http\Requests\StoreProject;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Cropper;

class ProjectEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating project';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'You are currently editing a department';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * @var string
     */
    public $permission = 'edit_projects';

    /**
     * Query data.
     *
     * @param Project $project
     *
     * @return array
     */
    public function query(Project $project): array
    {
        $this->exists = $project->exists;

        if ($this->exists) {
            $this->name = 'Edit project';
        }

        return [
            'project' => $project
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
            Button::make('Save')
                ->icon('icon-pencil')
                ->class('btn btn-success mr-2 p-1')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('icon-note')
                ->method('createOrUpdate')
                ->class('btn btn-success mr-2 p-1')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('icon-trash')
                ->class('btn btn-danger p-1')
                ->method('remove')
                ->canSee($this->exists),
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
            Layout::rows([
                Input::make('project.title')
                    ->title('Project Name')
                    ->placeholder('Name of project')
                    ->help('Enter the name of the project'),

                Quill::make('project.description')
                    ->title('Project Description')
                    ->help('Enter the description of the project'),

                Cropper::make('project.image')
                    ->width(400)
                    ->height(400)
                    ->targetRelativeUrl()
                    ->title('Project Cover Image'),

                Switcher::make('project.archived')
                    ->sendTrueOrFalse()
                    ->placeholder('Archive Project')
                    ->help('Select to archive this project. The default project setting is active.')
                    ->title('Archive Project'),
            ])
        ];
    }


    /**
     * @param Project $project
     * @param StoreProject $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Project $project, StoreProject $request)
    {
        $project->fill($request->get('project'))->save();

        Alert::info('You have successfully updated a project');

        return redirect()->route('project.list');
    }

    /**
     * @param Project $project
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Project $project)
    {
        $project->delete()
            ? Alert::info('You have successfully deleted the project.')
            : Alert::warning('An error has occurred');

        return redirect()->route('project.list');
    }
}
