<div class="container">
    <div class="row admin-wrapper">
        <div class="container">
            <div class="row m-b-xl text-left">
                <div class="wrapper w-full">
                    <div class="row">
                        @if($documentcategories->isEmpty())
                        <a class="btn btn-block btn-danger">No document categories</a>
                        @else
                        @foreach ($documentcategories as $documentcategory)
                        <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                            <div class="card shadow">
                            <img class="card-img-top" src="{{ asset($documentcategory->image) }}">
                                <div class="card-block b-t" style="padding:1em">
                                    <h6 class="card-title font-bold text-left text-success text-uppercase text-center"
                                        style="margin-bottom:0;">
                                        <a href="{{ route('documentcategory.view', $documentcategory->id) }}"
                                            class="text-success">{{ $documentcategory->name }}</a>
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
