<?php

namespace App\Orchid\Screens\User;

use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Access\UserSwitch;
use App\User;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Actions\DropDown;
use Illuminate\Support\Facades\Hash;

class PasswordEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Password';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Edit your password';

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
        if ($user->id != Auth::id()){
            $user = User::findOrFail(Auth::id());
        }
        
        $this->exists = $user->exists;
        
        return [
            'user' => $user
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
                ->method('changePassword'),
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
                Password::make('password')
                    ->title(__('Password'))
                    ->required()
                    ->placeholder(__('Enter a new password'))
                    ->width(400),
            ]),
        ];
    }

    /**
     * @param User    $user
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(User $user, Request $request)
    {
        $user->password = Hash::make($request->get('password'));
        $user->save();

        Alert::info(__('Your new password was saved'));

        return redirect()->route('platform.main');
    }
}
