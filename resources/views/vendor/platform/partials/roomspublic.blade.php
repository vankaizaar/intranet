<div class="row admin-wrapper">
    <div class="container">
        <div class="row m-b-xl text-left">
            <div class="wrapper w-full">
                <div class="row">
                    @if($rooms->isEmpty())
                    <a class="btn btn-block btn-danger">No rooms or facilities</a>
                    @else
                    @foreach ($rooms as $room)
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                        <div class="card shadow">
                            <div class="card-block" style="padding:1em">
                                <h6 class="card-title font-bold text-left text-success text-uppercase text-center"
                                    style="margin-bottom:0;">
                                    <a href="{{ route('room.view', $room->id) }}"
                                        class="linked">{{ $room->room_name }}</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


