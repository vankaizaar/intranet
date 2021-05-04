<?php

namespace App\Orchid\Screens\icpac\Projectfile;

use App\Projectfile;
use App\Orchid\Layouts\icpac\Projectfile\ProjectfileListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ProjectfileListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Project File';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Project Files';

    /**
     * Query data.
     * 
     * @param Projectfile $projectfile
     *
     * @return array
     */
    public function query(Projectfile $projectfile): array
    {
        return [
            'projectfiles' => Projectfile::filters()->defaultSort('id')->paginate()
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
                ->href(route('icpac.projectfile.create'))
                ->class('btn btn-warning')
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
            ProjectfileListLayout::class
        ];
    }
}
