<div class="container">
    <div class="row admin-wrapper">
        <div class="container">
            <div class="row m-b-xl text-left">
                <div class="wrapper w-full">
                    <div class="row">
                        @if($departments->isEmpty())
                        <div class="col-sm-12">
                            <a class="btn btn-block btn-danger">No departments</a>
                        </div>
                        @else
                        @foreach ($departments as $department)
                        <div class="col-sm-6 col-md-4 col-lg-4 mt-2">
                            <div class="card shadow">
                            <img class="card-img-top" src="{{ asset($department->image) }}">
                                <div class="card-block b-t" style="padding:1em">
                                    <h6 class="card-title font-bold text-left text-success text-uppercase text-center"
                                        style="margin-bottom:0;">
                                        <a href="{{ route('department.view', $department->id) }}"
                                            class="linked">{{ $department->name }}</a>
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
</div>
