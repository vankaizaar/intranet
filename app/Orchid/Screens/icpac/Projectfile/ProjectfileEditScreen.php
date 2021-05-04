<?php

namespace App\Orchid\Screens\icpac\Projectfile;

use App\Project;
use App\Projectfile;
use App\Http\Requests\StoreProjectFile;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class ProjectfileEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create a new Project File';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'You are currently editing a project file';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * @var string
     */
    public $permission = 'edit_project_files';

    /**
     * Query data.
     *
     * @param Projectfile $projectfile
     *
     * @return array
     */
    public function query(Projectfile $projectfile): array
    {
        $this->exists = $projectfile->exists;
        if ($this->exists) {
            $this->name = 'Edit project file';
            $projectfile->load('attachment');
        }
        return [
            'projectfile' => $projectfile,
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
                ->icon('icon-save')
                ->class('btn btn-success mr-2')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('icon-note')
                ->method('createOrUpdate')
                ->class('btn btn-success mr-2')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('icon-trash')
                ->class('btn btn-danger')
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
                Input::make('projectfile.updater')
                    ->type('hidden')->value(function () {
                        return Auth::id();
                    }),

                Input::make('projectfile.title')
                    ->help('Enter the title of the document')
                    ->title('Document name'),

                Select::make('projectfile.project_id')
                    ->fromQuery(Project::where('archived', '=', false), 'title')
                    ->help('Select the project for the document')
                    ->title('Project')
                    ->empty('No select'),

                Cropper::make('projectfile.cover_image')
                    ->required()
                    ->width(400)
                    ->height(400)
                    ->help('Image representation of the document i.e. jpg,png')
                    ->title('Document cover image'),

                Upload::make('projectfile.attachment')
                    ->maxFileSize(env('DOCUMENTS_MAXSIZE'))
                    ->maxFiles(1)
                    ->acceptedFiles(env('DOCUMENTS_ALLOWEDTYPES'))
                    ->groups('project')
                    ->help('Select the document')
                    ->title('Document'),

                Switcher::make('projectfile.is_private')
                    ->sendTrueOrFalse()
                    ->placeholder('Make File Private')
                    ->help('Select to make file ONLY visible to fellow project members. Default is files are public to all.')
                    ->title('Make File Private'),
            ]),
        ];
    }

    /**
     * @param Projectfile $projectfile
     * @param StoreProjectFile $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Projectfile $projectfile, StoreProjectFile $request)
    {
        $projectfile->fill($request->get('projectfile'))->save();

        $projectfile->attachment()->syncWithoutDetaching($request->input('projectfile.attachment', []));

        Alert::info('You have successfully created a project file.');

        return redirect()->route('project.list');
    }

    /**
     * @param Projectfile $projectfile
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Projectfile $projectfile)
    {
        $projectfile->delete()
            ? Alert::info('You have successfully deleted the project file.')
            : Alert::warning('An error has occurred');

        return redirect()->route('project.list');
    }
}
