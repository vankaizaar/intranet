<?php

namespace App\Orchid\Layouts\icpac\Department;

use Orchid\Screen\TD;
use App\Department;
use Orchid\Screen\Layouts\Table;

class DepartmentListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'departments';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [            
            TD::set('title', 'Department')
                ->render(function (Department $department) {                    
                    $route = route('icpac.department.edit', $department);
                    $title = e($department->name);

                    return "<a href='{$route}'>{$title}</a>";
                })
                ->width('250'),
            TD::set('description', 'Description'),            
            TD::set('created_at', 'Created'),
            TD::set('updated_at', 'Last edit'),
        ];
    }
}
