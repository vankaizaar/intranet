<?php

namespace App\Orchid\Screens\User;

use App\Department;
use App\Position;
use App\Project;
use App\Http\Requests\StoreUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class UserProfileEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Profile';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Edit your profile here';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param User $user
     *
     * @return array
     */
    public function query(User $user): array
    {
        if ($user->id != Auth::id()) {
            $user = User::findOrFail(Auth::id());
        }

        $this->exists = $user->exists;

        return [
            'user' => $user,
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
            Button::make(__('Save'))
                ->icon('icon-check')
                ->class('btn btn-success')
                ->method('update')
                ->canSee($this->exists),
        ];
    }

    /**
     *
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('user.password')
                    ->type('hidden')

                    ->value('password'),

                Input::make('user.name')
                    ->type('text')
                    ->max(255)

                    ->horizontal()
                    ->title(__('Name'))
                    ->placeholder(__('Name')),

                Input::make('user.email')
                    ->type('email')
                    ->max(255)

                    ->horizontal()
                    ->title(__('Email'))
                    ->placeholder(__('Email')),

                Input::make('user.telephone')
                    ->max(255)

                    ->horizontal()
                    ->mask('(9999) 999-999')
                    ->title(__('Telephone'))
                    ->placeholder(__('Telephone')),

                Relation::make('user.position_id')
                    ->type('text')

                    ->horizontal()
                    ->title(__('Position'))
                    ->placeholder(__('Position'))
                    ->fromModel(Position::class, 'name'),


                Cropper::make('user.avatar')
                    ->width(400)
                    ->height(400)

                    ->horizontal()
                    ->title(__('Profile Photo')),
            ]),
        ];
    }

    /**
     * @param User $user
     * @param StoreUser $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, StoreUser $request)
    {
        $user
            ->fill($request->get('user'))
            ->save();

        Alert::info(__('Your profile was saved'));

        return redirect()->route('platform.main');
    }
}
