<div class="container">
    <div class="row admin-wrapper">
        <div class="container">
            <div class="row m-b-xl text-left">
                <div class="wrapper w-full">
                    <h1 class="text-dark font-thin m-b-sm">
                        {{$document->title}}
                        @foreach ($document->attachment()->get() as $file)
                        <li>
                        <a href="{{ $file->url }}">{{ $document->title }}</a>
                            {{$file->size}}
                        </li>
                        @endforeach
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
