<?php

declare (strict_types=1);

namespace App\Orchid\Composers;

use Illuminate\Support\Facades\Auth;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\Menu;

class MainMenuComposer
{
    /**
     * @var Dashboard
     */
    private $dashboard;

    /**
     * MenuComposer constructor.
     *
     * @param Dashboard $dashboard
     */
    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    /**
     * Registering the main menu items.
     */
    public function compose()
    {
        // PROFILE
        $this->dashboard->menu
            ->add(Menu::PROFILE,
                ItemMenu::label('Edit your profile')
                    ->icon('icon-brush')
                    ->route('icpac.user.edit', [Auth::id()])
            )
            ->add(Menu::PROFILE,
                ItemMenu::label('Change your password')
                    ->icon('icon-lock')
                    ->route('icpac.user.password.edit', [Auth::id()])
            );

        //MAIN
        $this->dashboard->menu->add(
            Menu::MAIN,
            ItemMenu::label('DEPARTMENTS')
                ->icon('icon-organization')
                ->route('department.list')
        );
        $this->dashboard->menu->add(
            Menu::MAIN,
            ItemMenu::label('PROJECTS')
                ->icon('icon-modules')
                ->route('project.list')
        );

        $this->dashboard->menu->add(
            Menu::MAIN,
            ItemMenu::label('DOCUMENTS')
                ->icon('icon-new-doc')
                ->route('documentcategory.list')
        );

        $this->dashboard->menu->add(
            Menu::MAIN,
            ItemMenu::label('BOOKINGS')
                ->icon('icon-speech')
                ->route('room.list')
        );
        $this->dashboard->menu->add(
            Menu::MAIN,
            ItemMenu::label('STAFF')
                ->icon('icon-friends')
                ->slug('staff')
                ->route('icpac.staff.view')
        );

        $this->dashboard->menu->add(
            Menu::MAIN,
            ItemMenu::label('EVENTS')
                ->icon('icon-calendar')
                ->slug('events')
                ->route('icpac.calendar.view')
        );


    }
}
