<div class="container">
    <div class="row admin-wrapper">
        <div class="container">
            <div class="row text-left">
                <div class="wrapper w-full">
                    <h1 class="text-dark-lter font-thin m-b-sm">
                        {{$department->name}}
                    </h1>                    
                    <div class="dsds">
                        {!!$department->description!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row m-b-xl text-left">
        <div class="wrapper w-full">
            <h3 class="text-muted font-thin m-b-sm">Staff Members</h3>
            <div class="row">
                @if($department->users->isEmpty())
                <a class="btn btn-block btn-danger">No staff members associated with this department</a>
                @else

                @foreach ($department->users as $user)
                <div class="col-sm-6 col-md-4 col-lg-4 mt-2">
                    <div class="card shadow">
                        <img class="card-img-top" src="{{ $user->avatar }}">
                        <div class="card-block b-t" style="padding:1em">
                            <h6 class="card-title font-bold text-left text-success" style="margin-bottom:0;">
                                {{ $user->name }}
                            </h6>
                            <span style="margin-bottom:1em; display:block;"> {{ $user->position->name }}</span>
                            <div class="meta">
                                <a style="display:block;font-size:0.8em" href="mailto:{{$user->email}}"><i
                                        class="icon-envelope m-r-xs text-warning"></i> {{ $user->email }}</a>
                                <a style="display:block;font-size:0.8em" href="tel:{{$user->telephone}}"><i
                                        class="icon-phone m-r-xs text-warning"></i> {{ $user->telephone }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
