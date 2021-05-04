<?php

namespace App\Orchid\Screens\icpac\MediaCategory;

use App\MediaCategory;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Illuminate\Http\Request;

class MediaCategoryEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Media Categories';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'MediaCategoryEditScreen';

     /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param MediaCategory $mediacategory
     *
     * @return array
     */
    public function query(MediaCategory $mediacategory): array
    {
        $this->exists = $mediacategory->exists;
        if($this->exists){
            $this->name = 'Edit category';
        }
        return [
            'mediacategory' => $mediacategory
        ];
    }

    /**
     * Button commands.
     *
     * @return Button[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create Media Category')
                ->icon('icon-pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists)
                ->class('btn btn-warning dropdown-item'),

            Button::make('Update')
                ->icon('icon-note')
                ->method('createOrUpdate')
                ->canSee($this->exists)
                ->class('btn btn-success dropdown-item'),

            Button::make('Remove')
                ->icon('icon-trash')
                ->method('remove')
                ->canSee($this->exists)
                ->class('btn btn-danger dropdown-item'),
        ];;
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
                Input::make('mediacategory.name')
                    ->title('Title')
                    ->max(255)
                    ->placeholder('Set media category title'),
                Quill::make('mediacategory.description')
                    ->max(255)
                    ->title('Description'),

            ])
        ];
    }

     /**
     * @param MediaCategory $mediacategory
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(MediaCategory $mediacategory, Request $request)
    {
        $mediacategory->fill($request->get('mediacategory'))->save();

        Alert::info('You have successfully created a document category.');

        return redirect()->route('icpac.mediacategory.list');
    }

    /**
     * @param MediaCategory $mediacategory
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(MediaCategory $mediacategory)
    {
        $mediacategory->delete()
            ? Alert::info('You have successfully deleted the document category.')
            : Alert::warning('An error has occurred')
        ;

        return redirect()->route('icpac.mediacategory.list');
    }
}
