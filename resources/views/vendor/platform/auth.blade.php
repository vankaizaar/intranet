@extends('platform::app-full-width')
@section('body-center')
<div class="v-center h-100 w-100 justify-content-center loginbody">
    <div class="container">
        <div class="row">
            <div class="col mx-auto" style="max-width: 30rem;">
                <div class="translucent relative block">
                    <a href="/"><img src="{{ asset('images/icpac-logo.svg') }}" alt="ICPAC"
                            class="img-fluid p-3 ml-auto mr-auto block"></a>
                    <hr>
                    <div class="px-5 py-3">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection