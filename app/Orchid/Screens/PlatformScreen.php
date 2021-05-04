<?php

declare (strict_types = 1);

namespace App\Orchid\Screens;

use App\Event;
use App\User;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class PlatformScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Welcome';

    /**
     * Display header description.
     *
     * @var mixed
     */
    public $description = '';

    /**
     * Query data.
     *
     * @param User $user
     *
     * @return array
     */
    public function query(User $user): array
    {        
        $this->description = Auth::user()->getNameTitle();

        return [
            'events' => Event::all(),
            'today' => date("Y-m-d"),
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
            Layout::view('platform::partials.welcome'),
        ];
    }
}
