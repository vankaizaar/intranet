<div class="row admin-wrapper b-t">
    <div class="container">
        <div class="row m-b-xl text-left">
            <div class="wrapper w-full">                
                <h1 class="text-dark font-thin m-t-md m-b-sm">                                    
                    {{$mediacategory->name}}               
                </h1>  
                <h3 class="text-muted font-thin m-t-md m-b-sm">About</h3>
                <div class="">
                    {!!$mediacategory->description!!}                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">                                                               
                    @if($mediacategory->medias->isEmpty())
                        <p class="lead text-white mb-0 font-bold d-block text-center bg-danger">This Section has no files associated with it.</p>                    
                    @else 
                    <h3 class="text-muted font-thin m-t-md m-b-sm">Project Files</h3>                                                            
                    <div class="row">                                            
                        @foreach ($mediacategory->medias as $media)                         
                        @foreach ($media->attachment()->get() as $file)
                        <div class="col-md-3">
                            <a href="{{ $file->url }}" target="_blank">
                                {{$media->title}}
                            </a>
                        </div>   
                        @endforeach                                                                                                                                                                        
                        @endforeach
                        </div>    
                    @endif                 
            </div>                       
        </div>       
    </div> 
</div>
