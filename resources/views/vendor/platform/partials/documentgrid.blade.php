<div class="container">
    <div class="row m-b-xl text-left">
        <div class="wrapper w-full">
            <div class="row">
                @if($documents->isEmpty())
                    <div class="col-sm-12">
                        <a class="btn btn-block btn-danger">No documents in this category</a>
                    </div>
                @else
                    @foreach ($documents as $document)
                        <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                            <div class="card shadow">
                                <img class="card-img-top" src="{{ $document->getCover() }}">
                                <div class="card-block b-t" style="padding:1em">
                                    <p class="card-title font-bold text-left text-success" style="margin-bottom:0;">
                                        {{ $document->title }}
                                    </p>
                                    <div class="meta">
                                        <p class="type">
                                            <span class="badge badge-dark inline">
                                                {{$document->attachment()->first()->user()->first()->getNameTitle()}}
                                            </span>
                                            <span
                                                class="badge badge-dark inline">{{strtoupper($document->attachment()->first()->extension)}}
                                            </span>
                                            <span class="badge badge-dark inline">
                                                {{\App\Orchid\Layouts\icpac\Document\DocumentListLayout::filesize_formatted($document->attachment()->first()->size)}}
                                            </span>
                                            <span class="badge badge-dark inline">
                                                {{\Carbon\Carbon::parse($document->created_at)->diffForHumans()}}
                                            </span>
                                        </p>
                                        <p class="author">
                                            <span class="text-black">Last Edit:</span>
                                            {{\Carbon\Carbon::parse($document->updated_at)->diffForHumans()}}
                                        </p>
                                        <p class="author">
                                            <span class="text-black">Edited by:</span>
                                            @php
                                                $userID = $document->updater;
                                                if(\App\User::find($userID)){
                                                    echo \App\User::find($userID)->getNameTitle();
                                                }
                                            @endphp

                                        </p>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{$document->attachment()->first()->url()}}" target="_blank"
                                           class="btn btn-block btn-success">
                                            <i class='icon-cloud-download'></i>
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div>
            {{ $documents->links() }}
        </div>
    </div>
</div>
