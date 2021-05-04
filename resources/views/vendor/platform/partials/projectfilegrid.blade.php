<div class="container">
    <div class="row m-b-xl text-left">
        <div class="wrapper w-full">
            <div class="row">
                @if($projectfiles->isEmpty())
                <div class="col-sm-12">
                <a class="btn btn-block btn-danger">No documents in this project</a>
                </div>
                @else
                @foreach ($projectfiles as $projectfile)
                        <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                            <div class="card shadow">
                                <img class="card-img-top" src="{{ $projectfile->getCover() }}">
                                <div class="card-block b-t" style="padding:1em">
                                    <p class="card-title font-bold text-left text-success" style="margin-bottom:0;">
                                        {{ $projectfile->title }}
                                    </p>
                                    <div class="meta">
                                        <p class="type">
                                            <span class="badge badge-dark inline">
                                                {{$projectfile->attachment()->first()->user()->first()->getNameTitle()}}
                                            </span>
                                            <span
                                                class="badge badge-dark inline">{{strtoupper($projectfile->attachment()->first()->extension)}}
                                            </span>
                                            <span class="badge badge-dark inline">
                                                {{\App\Orchid\Layouts\icpac\Projectfile\ProjectfileListLayout::filesize_formatted($projectfile->attachment()->first()->size)}}
                                            </span>
                                            <span class="badge badge-dark inline">
                                                {{\Carbon\Carbon::parse($projectfile->created_at)->diffForHumans()}}
                                            </span>
                                        </p>
                                        <p class="author">
                                            <span class="text-black">Last Edit:</span>
                                            {{\Carbon\Carbon::parse($projectfile->updated_at)->diffForHumans()}}
                                        </p>
                                        <p class="author">
                                            <span class="text-black">Edited by:</span>
                                            @php
                                                $userID = $projectfile->updater;
                                                if(\App\User::find($userID)){
                                                    echo \App\User::find($userID)->getNameTitle();
                                                }
                                            @endphp

                                        </p>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{$projectfile->attachment()->first()->url()}}" target="_blank"
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
            {{ $projectfiles->links() }}
        </div>
    </div>
</div>
