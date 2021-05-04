<?php

namespace App\Orchid\Layouts\icpac\Project;

use App\Project;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class ProjectListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'projects';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            
            TD::set('title', 'Project Title')
                ->width('150')
                ->render(function (Project $project) {
                    // Please use view('path')
                    $route = route('icpac.project.edit', $project);
                    $title = e($project->title);

                    return "<a href='{$route}'>{$title}</a>";
                }),
            TD::set('description', 'Description')
            ->width('450'),
            TD::set('created_at', 'Created'),
            TD::set('updated_at', 'Last edit'),
        ];
    }
}
