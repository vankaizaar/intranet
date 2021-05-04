<?php

namespace App\Orchid\Screens\icpac\Department;

use App\Department;
use App\Http\Requests\StoreDepartment;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Cropper;

class DepartmentEditScreen extends Screen


{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating Department';

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
    public $permission = 'edit_department';

    /**
     * Query data.
     *
     * @param Department $department
     *
     * @return array
     */
    public function query(Department $department): array
    {

        $this->exists = $department->exists;

        if ($this->exists) {
            $this->name = 'Edit department';
        }

        return [
            'department' => $department
        ];
    }

    /**
     * Button commands.
     *
     * @return Button[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Save')
                ->icon('icon-save')
                ->method('createOrUpdate')
                ->class('btn btn-block btn-success p-1')
                ->canSee(!$this->exists),

            Button::make('Update Department')
                ->icon('icon-note')
                ->class('btn btn-success mr-2 p-1')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove Department')
                ->icon('icon-trash')
                ->method('remove')
                ->class('btn btn-danger p-1')
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
                Input::make('department.name')
                    ->placeholder('Enter Department')
                    ->title('Department Name'),

                Quill::make('department.description')
                    ->placeholder('Enter department description')
                    ->title('Department Description'),

                Cropper::make('department.image')
                    ->width(400)
                    ->height(400)
                    ->targetRelativeUrl()
                    ->title('Department Cover Image'),
            ])
        ];
    }

    /**
     * @param Department $department
     * @param StoreDepartment $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Department $department, StoreDepartment $request)
    {
        //dd($request);
        $department->fill($request->get('department'))->save();

        Alert::info('Department saved');

        return redirect()->route('department.list');
    }

    /**
     * @param Department $department
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Department $department)
    {
        $department->delete()
            ? Alert::info('Department deleted')
            : Alert::warning('An error has occurred');
        return redirect()->route('department.list');
    }
}
