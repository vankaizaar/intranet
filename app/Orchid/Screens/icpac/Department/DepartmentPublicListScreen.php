<?php

namespace App\Orchid\Screens\icpac\Department;

use App\Department;
use Orchid\Screen\Screen;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;

class DepartmentPublicListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Departments';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'List of all ICPAC Departments';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Department $department): array
    {
        return [
            'departments' => Department::all(),
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
            Link::make('Create New Department')
            ->href(route('department.create'))
            ->class('btn btn-block btn-info p-1')
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
            Layout::view('platform::partials.departmentspublic'),
        ];
    }
}
