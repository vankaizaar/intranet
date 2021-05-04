<?php

namespace App\Orchid\Screens\icpac\Position;

use App\Position;
use App\Http\Requests\StorePosition;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class PositionEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Positions';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Staff Positions';

    /**
     * @var string
     */
    public $permission = 'platform.systems.positions';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Position $position
     *
     * @return array
     */
    public function query(Position $position): array
    {
        $this->exists = $position->exists;

        if ($this->exists) {
            $this->name = 'Edit position';
        }
        return [
            'position' => $position,
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Save')
                ->icon('icon-pencil')
                ->method('createOrUpdate')
                ->class('btn btn-success p-1')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('icon-note')
                ->method('createOrUpdate')
                ->class('btn btn-success p-1 m-r')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('icon-trash')
                ->method('remove')
                ->class('btn btn-danger p-1 m-r')
                ->canSee($this->exists),
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
                Input::make('position.name')
                    ->placeholder('Enter a position title/name')
                    ->title('Name'),
            ]),
        ];
    }

    /**
     * @param Position $position
     * @param StorePosition $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Position $position, StorePosition $request)
    {
        $position->fill($request->get('position'))->save();

        Alert::info('Position updated');

        return redirect()->route('platform.systems.positions');
    }

    /**
     * @param Position $position
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Position $position)
    {
        $position->delete()
        ? Alert::info('Position deleted')
        : Alert::warning('An error has occurred')
        ;

        return redirect()->route('platform.systems.positions');
    }
}
