<?php

namespace App\Orchid\Screens\icpac\DocumentCategory;

use App\DocumentCategory;
use App\Http\Requests\StoreDocumentCategory;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class DocumentCategoryEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating document category';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'You are currently editing a document category';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * @var string
     */
    public $permission = 'edit_document_categories';

    /**
     * Query data.
     *
     * @param DocumentCategory $documentcategory
     *
     * @return array
     */
    public function query(DocumentCategory $documentcategory): array
    {
        $this->exists = $documentcategory->exists;
        if ($this->exists) {
            $this->name = 'Edit document category';
        }
        return [
            'documentcategory' => $documentcategory,
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
            Button::make('Save')
                ->icon('icon-pencil')
                ->class('btn btn-success p-1')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('icon-note')
                ->class('btn btn-success mr-2 p-1')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('icon-trash')
                ->class('btn btn-danger p-1')
                ->method('remove')
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
                Input::make('documentcategory.name')
                    ->title('Document Category Name')
                    ->max(255)
                    ->placeholder('Name of document category')
                    ->help('Enter the name of the document category'),
                Quill::make('documentcategory.description')
                    ->max(255)
                    ->title('Document Category Description')
                    ->help('Enter the description of the project'),
                Cropper::make('documentcategory.image')
                    ->width(400)
                    ->height(400)
                    ->targetRelativeUrl()
                    ->title('Document Cover Image'),
            ]),
        ];
    }

    /**
     * @param DocumentCategory $documentcategory
     * @param StoreDocumentCategory $request
     *
     * @return Response
     */
    public function createOrUpdate(DocumentCategory $documentcategory, StoreDocumentCategory $request)
    {
        $documentcategory->fill($request->get('documentcategory'))->save();

        Alert::info('You have successfully edited a document category');

        return redirect()->route('documentcategory.list');
    }

    /**
     * @param DocumentCategory $documentcategory
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(DocumentCategory $documentcategory)
    {
        $documentcategory->delete()
            ? Alert::info('You have successfully deleted the document category')
            : Alert::warning('An error has occurred');

        return redirect()->route('documentcategory.list');
    }
}
