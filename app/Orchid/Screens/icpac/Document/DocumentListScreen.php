<?php

namespace App\Orchid\Screens\icpac\Document;

use App\Orchid\Layouts\icpac\Document\DocumentListLayout;
use App\Document;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class DocumentListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Documents';

    /**
     * @var string
     */
    public $permission = 'platform.systems.attachment';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'List of all documents';

    /**
     * Query data.
     * @param Document $document
     * @return array
     */
    public function query(Document $document): array
    {
        return [
            'documents' => Document::filters()->defaultSort('id')->paginate()
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
            Link::make('Create new')
                ->icon('icon-pencil')
                ->href(route('document.create'))
                ->class('btn btn-warning p-1')
                ->icon('icon-plus')
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
            DocumentListLayout::class
        ];
    }
}
