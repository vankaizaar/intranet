<div class="row admin-wrapper">
    <div class="container">
        <div class="row m-b-xl text-left">
            <div class="wrapper w-full">                
                <h1 class="text-dark font-thin m-t-md m-b-sm">                                    
                    {{$roombooking->title}}               
                </h1>  
                <h3 class="text-muted font-thin m-t-md m-b-sm">Booking Details</h3>
                <div class="">
                    {!!$roombooking->description!!}     
                    {{$roombooking->room_id}}                 
                    {{$roombooking->start_time}} 
                    {{$roombooking->end_time}} 
                    {{$roombooking->attendees}}
                </div>
            </div>
        </div>              
    </div> 
</div>
