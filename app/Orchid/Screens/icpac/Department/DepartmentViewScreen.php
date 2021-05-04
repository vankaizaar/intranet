<?php

namespace App\Orchid\Screens\icpac\Department;

use App\Department;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class DepartmentViewScreen extends Screen
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
    
    public $description = 'You are currently viewing a department';

    /**
     * Query data.
     *
     * @param Department $department
     *
     * @return array
     */
    public function query(Department $department): array
    {
        $this->departmentID = $department->id;        
        return [
            'department' => $department,
        ];
    }

    /**
     * Button commands.
     *
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Edit Department')
                ->href(route('department.edit', $this->departmentID))
                ->class('btn btn-block btn-success p-1')
                ->icon('icon-note'),
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
            Layout::view('platform::partials.department'),
        ];
    }
}
