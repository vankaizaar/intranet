<?php

namespace App\Orchid\Layouts\icpac\Projectfile;

use App\Projectfile;
use App\User;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class ProjectfileListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'projectfiles';

    public static function filesize_formatted($path)
    {
        $size = $path;
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 0, '.', ',') . ' ' . $units[$power];
    }

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::set('id', 'ID')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->sort()
                ->link('icpac.projectfile.edit', 'id'),

            TD::set('id', 'Size/Type')
                ->sort()
                ->render(function (Projectfile $projectfile) {
                    $size = $this->filesize_formatted($projectfile->attachment()->first()->size);
                    $extension = strtoupper($projectfile->attachment()->first()->extension);
                    return $size . "<br/>" . $extension;
                }),

            TD::set('cover_image', 'Cover')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->sort()
                ->render(function (Projectfile $projectfile) {
                    $cover = e($projectfile->getCover());
                    return "<img src='{$cover}' height='50'>";
                }),

            TD::set('title', 'Title')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->link('icpac.projectfile.edit', 'id', 'title')
                ->width('250')
                ->align('center'),

            TD::set('project_id', 'Project')
                ->width('250')
                ->sort()
                ->align('center')
                ->render(function (Projectfile $projectfile) {
                    $cover = e($projectfile->project->title);
                    return "$cover";
                }),

            TD::set('project_id', 'Uploaded By')
                ->width('250')
                ->sort()
                ->align('center')
                ->render(function (Projectfile $projectfile) {
                    $userID = $projectfile->attachment()->first()->user_id;
                    $userName = e(User::find($userID)->getNameTitle());
                    return "$userName";
                }),

            TD::set('id', '')
                ->width('250')
                ->sort()
                ->align('center')
                ->render(function (Projectfile $projectfile) {

                    $link = e($projectfile->attachment()->first()->url());
                    return "<div class='form-group'><a class='btn btn-info' href='{$link}' target='new'><i class='icon-cloud-download'></i></a></div>";
                }),
        ];
    }
}
