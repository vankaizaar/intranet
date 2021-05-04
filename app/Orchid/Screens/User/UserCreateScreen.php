<?php

namespace App\Orchid\Screens\User;

use App\User;
use App\Orchid\Layouts\User\UserCreateLayout;
use App\Orchid\Layouts\User\UserRoleLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Illuminate\Support\Str;
use App\Notifications\NewUser;
use App\Http\Requests\StoreUserByAdmin;


class UserCreateScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Users';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Create a new user';

    /**
     * @var string
     */
    public $permission = 'platform.systems.users';

    /**
     * Query data.
     *
     * @param User $user
     *
     * @return array
     */
    public function query(User $user): array
    {
        $user->load(['roles']);

        return [
            'user' => $user,
            'permission' => $user->getStatusPermission(),
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
                ->method('create'),
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
            UserCreateLayout::class,
            UserRoleLayout::class,
        ];
    }

    /**
     * @param User $user
     * @param StoreUserByAdmin $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(User $user, StoreUserByAdmin $request)
    {
        $password = Str::random(8);
        $hashedPassword = Hash::make($password);
        $avatar = "https://www.gravatar.com/avatar/f9879d71855b5ff21e4963273a886bfc?s=200";
        $permissions = collect($request->get('permissions'))
            ->map(function ($value, $key) {
                return [base64_decode($key) => $value];
            })
            ->collapse()
            ->toArray();
        $user
            ->fill($request->get('user'))
            //->fill($request->input('user.roles'))
            ->fill([
                'permissions' => $permissions,
                'password' => $hashedPassword,
                'avatar' => $avatar,
            ])
            ->save();
        $user->replaceRoles($request->input('user.roles'));
        $user->notify(new NewUser($password));
        Alert::info(__('User created'));

        return redirect()->route('platform.systems.users');
    }
}
