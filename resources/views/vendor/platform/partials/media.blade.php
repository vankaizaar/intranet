<div class="row admin-wrapper b-t">
    <div class="container">
        <div class="row m-b-xl text-left">
            <div class="wrapper w-full">                
                <h1 class="text-dark font-thin m-t-md m-b-sm">                                     
                    {{$media->title}}               
                </h1>                                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">                                                                  
                    @if($media->attachment()->get()->isEmpty())
                        <p class="lead text-danger">This media has no files associated with it.</p>                    
                    @else                     
                    <h3 class="text-muted font-thin m-t-md m-b-sm">Media Files</h3>  
                    <div class="row">
                    @foreach ($media->attachment()->get() as $mediafile)                        
                        <div class="col-md-6">
                            <a href="{{$mediafile->relativeUrl}}" target="_blank">
                                <img src="{{$mediafile->relativeUrl}}" class="img-responsive text-success">
                                <h5 class="text-success font-weight-bold text-center">{{$mediafile->title}}</h5>
                            </a>
                        </div>  
                        <div class="col-md-6">
                            <a href="{{$mediafile->relativeUrl}}" target="_blank">
                                <img src="{{$mediafile->relativeUrl}}" class="img-responsive text-success">
                                <h5 class="text-success font-weight-bold text-center">{{$mediafile->title}}</h5>
                            </a>
                        </div>                                                                                                                                                         
                        @endforeach
                    </div>                                                          
                    @endif                 
            </div>                       
        </div>       
    </div> 
</div>
