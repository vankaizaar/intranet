<?php

namespace App\Orchid\Layouts\icpac\Document;

Use App\Document;
use App\User;
use Auth;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Carbon\Carbon;

class DocumentListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'documents';

    /**
     * @param $path
     * @return string
     */

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
                ->link('document.edit', 'id'),

            TD::set('title', 'Title')
                ->width(250)
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->align('center'),

            TD::set('id', 'Size/Type')
                ->width('150')
                ->sort()
                ->align('center')
                ->render(function (Document $document) {
                    $size = $this->filesize_formatted($document->attachment()->first()->size);
                    $extension = "<span class='badge badge-dark'>" . strtoupper($document->attachment()->first()->extension) . "</span>";
                    return $size . " " . $extension;
                }),
            TD::set('project_id', 'Uploaded By')
                ->width('200')
                ->sort()
                ->align('center')
                ->render(function (Document $document) {
                    $userID = $document->attachment()->first()->user_id;
                    $userName = e(User::find($userID)->getNameTitle());
                    $time = "<span class='badge badge-dark'>" . Carbon::parse($document->created_at)->diffForHumans() . "</span>";
                    return $userName . " " . $time;
                }),

            TD::set('project_id', 'Updated By')
                ->width('200')
                ->sort()
                ->align('center')
                ->render(function (Document $document) {
                    $userID = $document->updater;
                    $userName = e(User::find($userID)->getNameTitle());
                    $time = "<span class='badge badge-dark'>" . Carbon::parse($document->updatedted_at)->diffForHumans() . "</span>";
                    return $userName . " " . $time;
                }),

            TD::set('id', '')
                ->align('center')
                ->render(function (Document $document) {
                    $link = e($document->attachment()->first()->url());
                    return "<a class='btn btn-block btn-info btn-small' href='{$link}' target='new'><i class='icon-cloud-download'></i></a>";
                }),
        ];
    }
}
