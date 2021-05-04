<?php

namespace App\Orchid\Screens\icpac\DocumentCategory;

use App\Document;
use App\User;
use App\DocumentCategory;
use App\Orchid\Layouts\icpac\Document\DocumentListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class DocumentCategoryViewScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Documents';


    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'You are currently viewing a document category';

    /**
     * Query data.
     *
     * @param DocumentCategory $documentcategory
     *
     * @return array
     */
    public function query(DocumentCategory $documentcategory): array
    {
        $this->DocumentCategoryID = $documentcategory->id;
        return [
            'documentcategory' => $documentcategory,
            'documents' => Document::where('document_category_id', $documentcategory->id)->filters()->defaultSort('id')->paginate(),
            'users' => User::all(),
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
            Link::make('Edit Document Category')
                ->href(route('documentcategory.edit', $this->DocumentCategoryID))
                ->class('btn btn-warning mr-2 p-1')
                ->icon('icon-note'),

            Link::make('Edit Uploaded Files')
                ->href(route('document.list'))
                ->class('btn btn-info mr-2 p-1')
                ->icon('icon-note'),

            Link::make('Add Files')
                ->href(route('document.create'))
                ->class('btn btn-success mr-2 p-1')
                ->icon('icon-plus'),
        ];
    }

    /**
     * Views.
     *
     * @throws \Throwable
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            Layout::view('platform::partials.documentcategory'),
            Layout::tabs([
                '<i class="icon-grid"></i>' => Layout::view('platform::partials.documentgrid'),
                '<i class="icon-list"></i>' => DocumentListLayout::class,
            ]),
        ];
    }
}
