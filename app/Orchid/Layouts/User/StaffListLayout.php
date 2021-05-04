<?php

namespace App\Orchid\Layouts\User;

use App\User;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StaffListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'users';

    /**
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::set('avatar', '')
                ->align(TD::ALIGN_CENTER)
                ->width('50px')
                ->render(function (User $user) {
                    $avatar = e($user->getAvatar());
                    return "<img src='{$avatar}' height='50'>";
                }),
            TD::set('name', 'Name')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->width('150')
                ->align('Left'),

            TD::set('position_id', 'Title')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->width('150')
                ->align('left')
                ->render(function (User $user) {
                    $title = e($user->position->name);
                    return "$title";
                }),
            TD::set('email', 'Email')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->width('150')
                ->align('left'),
            TD::set('telephone', 'Telephone')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->width('100')
                ->align('center'),
        ];
    }
}
