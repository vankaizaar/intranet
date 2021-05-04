<?php

namespace App\Orchid\Screens\icpac\Document;

use App\Document;
use App\DocumentCategory;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use App\Http\Requests\StoreDocument;

class DocumentEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create document';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'You are currently creating a document';

    /**
     * @var string
     */
    public $permission = 'edit_document';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Document $document
     *
     * @return array
     */
    public function query(Document $document): array
    {
        $this->exists = $document->exists;
        if ($this->exists) {
            $this->name = 'Edit document';
            $document->load('attachment');
        }


        return [
            'document' => $document,
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
                Input::make('document.updater')
                    ->type('hidden')->value(function () {
                        return Auth::id();
                    }),

                Input::make('document.title')
                    ->placeholder('Name of file')
                    ->title('Title'),

                Select::make('document.document_category_id')
                    ->fromModel(DocumentCategory::class, 'name')
                    ->title('Select document category')
                    ->empty('No select'),

                Cropper::make('document.cover_image')
                    ->vertical()
                    ->width(400)
                    ->height(600)
                    ->title(__('Document Cover Image')),

                Upload::make('document.attachment')
                    ->maxFileSize(env('DOCUMENTS_MAXSIZE'))
                    ->maxFiles(1)
                    ->min(1)
                    ->acceptedFiles(env('DOCUMENTS_ALLOWEDTYPES'))
                    ->groups('document')
                    ->title('Select file')
                    ->help('Please select a file. DO NOT SAVE until the upload here is done. Otherwise an error will occur.'),
            ]),
        ];
    }

    /**
     * @param Document $document
     * @param StoreDocument $request
     *
     * @return Response
     */
    public function createOrUpdate(Document $document, StoreDocument $request)
    {

        $document->fill($request->get('document'))->save();

        $document->attachment()->syncWithoutDetaching($request->input('document.attachment', []));

        Alert::info('Document created');

        return redirect()->route('documentcategory.list');
    }

    /**
     * @param Document $document
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Document $document)
    {
        $document->delete()
            ? Alert::info('Document deleted')
            : Alert::warning('An error has occurred');

        return redirect()->route('documentcategory.list');
    }
}
