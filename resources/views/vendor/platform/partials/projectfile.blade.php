<div class="container">
    <div class="row admin-wrapper b-t">
        <div class="container">
            <div class="row m-b-xl text-left">
                <div class="wrapper w-full">
                    <h1 class="text-dark font-thin m-t-md m-b-sm">
                        {{$projectfile->title}}
                        @foreach ($projectfile->attachment()->get() as $file)
                        <li><a href="{{ $file->url }}">{{ $projectfile->title }}</a>
                            {{$file->size}}
                        </li>
                        @endforeach
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
