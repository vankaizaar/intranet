<?php

namespace App\Orchid\Screens\icpac\Department;

use App\Department;
use App\Orchid\Layouts\icpac\Department\DepartmentListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class DepartmentListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Departments List';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'ICPAC Departments';

    /**
     * Query data.
     *
     * @param Department $department
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
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create New Department')
                ->href(route('icpac.department.create'))
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
            DepartmentListLayout::class,
        ];
    }
}
