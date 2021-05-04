<?php

namespace App\Orchid\Screens\icpac\Media;

use App\Media;
use App\MediaCategory;
use App\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class MediaEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create a new media file';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Edit media';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Media $media
     *
     * @return array
     */
    public function query(Media $media): array
    {
        $this->exists = $media->exists;

        if($this->exists){
            $this->name = 'Edit media';
            $media->load('attachment');
        }

        return [
            'media' => $media
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
            Button::make('Create media file')
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
                Input::make('media.title')
                    ->title('Title')
                    ->placeholder('Name of file'),

                Relation::make('media.media_category_id')
                    ->title('Category')
                    ->placeholder('Media Category')
                    ->help('This is the section that the medium will go to in the main menu')
                    ->fromModel(MediaCategory::class, 'name'),

                Upload::make('media.attachment')
                    ->maxFileSize(51200)
                    ->maxFiles(1)
                    ->acceptedFiles('image/*,video/*')
                    ->groups('media')
                    ->title('File to upload'),

            ])
        ];
    }

    /**
     * @param Media    $media
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Media $media, Request $request)
    {
        $media->fill($request->get('media'))->save();

        $media->attachment()->syncWithoutDetaching($request->input('media.attachment', []));

        Alert::info('You have successfully created an media.');

        return redirect()->route('icpac.media.list');
    }

    /**
     * @param Media $media
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Media $media)
    {
        $media->delete()
            ? Alert::info('You have successfully deleted the media.')
            : Alert::warning('An error has occurred')
        ;

        return redirect()->route('icpac.media.list');
    }
}
