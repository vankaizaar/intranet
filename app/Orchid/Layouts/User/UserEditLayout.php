<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Position;
use App\Department;
use App\Project;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * Views.
     *
     * @throws \Throwable|\Orchid\Screen\Exceptions\TypeException
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('user.password')
                ->type('hidden')
                ->required()
                ->value('password'),

            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->horizontal()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('user.email')
                ->type('email')
                ->max(255)
                ->required()
                ->horizontal()
                ->title(__('Email'))
                ->placeholder(__('Email')),

            Input::make('user.telephone')
                ->max(255)
                ->required()
                ->horizontal()
                ->mask('(9999) 999-999')
                ->title(__('Telephone'))
                ->placeholder(__('Telephone')),

            Relation::make('user.position_id')
                ->type('text')
                ->required()
                ->horizontal()
                ->title(__('Position'))
                ->placeholder(__('Position'))
                ->fromModel(Position::class, 'name'),

            Relation::make('user.department_id')
                ->type('text')
                ->required()
                ->horizontal()
                ->title(__('Department'))
                ->placeholder(__('Department'))
                ->fromModel(Department::class, 'name'),

            Relation::make('user.projects.')
                ->type('text')
                ->multiple()
                ->horizontal()
                ->title(__('Projects'))
                ->placeholder(__('Projects'))
                ->fromModel(Project::class, 'title')
                ->applyScope('archived')
                ->empty('No select', 0),

            Cropper::make('user.avatar')
                ->width(400)
                ->height(400)
                ->required()
                ->title(__('Profile Photo')),
        ];
    }
}
