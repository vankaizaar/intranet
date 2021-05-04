<?php

namespace App\Orchid\Screens\icpac\Document;

use App\Document;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class DocumentViewScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Document';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Viewing document';

    /**
     * Query data.
     * 
     * @param Document $document
     *
     * @return array
     */
    public function query(Document $document): array
    {                        
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
        return [];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::view('platform::partials.document'),
        ];
    }
}
