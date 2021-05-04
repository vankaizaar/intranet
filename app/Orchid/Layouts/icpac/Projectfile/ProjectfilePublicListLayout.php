<?php

namespace App\Orchid\Layouts\icpac\Projectfile;

use App\Projectfile;
use App\User;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;
use Carbon\Carbon;

class ProjectfilePublicListLayout extends Table
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
                ->sort()
                ->link('projectfile.edit', 'id'),

            TD::set('title', 'Title')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->width('250')
                ->align('center'),

            TD::set('id', 'Size/Type')
                ->sort()
                ->align('center')
                ->width('150')
                ->render(function (Projectfile $projectfile) {
                    $size = $this->filesize_formatted($projectfile->attachment()->first()->size);
                    $extension = "<span class='badge badge-dark'>" . strtoupper($projectfile->attachment()->first()->extension) . "</span>";
                    return $size . " " . $extension;
                }),


            TD::set('project_id', 'Uploaded By')
                ->width('200')
                ->sort()
                ->align('center')
                ->render(function (Projectfile $projectfile) {
                    $userID = $projectfile->attachment()->first()->user_id;
                    $userName = e(User::find($userID)->getNameTitle());
                    $time = "<span class='badge badge-dark'>" . Carbon::parse($projectfile->created_at)->diffForHumans() . "</span>";
                    return $userName . " " . $time;
                }),

            TD::set('project_id', 'Updated By')
                ->width('200')
                ->sort()
                ->align('center')
                ->render(function (Projectfile $projectfile) {
                    $userID = $projectfile->updater;
                    $userName = e(User::find($userID)->getNameTitle());
                    $time = "<span class='badge badge-dark'>" . Carbon::parse($projectfile->updatedted_at)->diffForHumans() . "</span>";
                    return $userName . " " . $time;
                }),

            TD::set('id', '')
                ->width('250')
                ->sort()
                ->align('center')
                ->render(function (Projectfile $projectfile) {
                    $link = e($projectfile->attachment()->first()->url());
                    return "<a class='btn btn-info' href='{$link}'><i class='icon-cloud-download'></i></a>";
                }),
        ];
    }
}
