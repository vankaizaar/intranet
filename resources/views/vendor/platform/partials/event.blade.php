<div class="row admin-wrapper b-t">
    <div class="container">
        <div class="row m-b-xl text-left">
            <div class="wrapper w-full">                
                <h1 class="text-dark font-thin m-t-md m-b-sm">                                    
                    {{$event->event_title}}               
                </h1>                  
                <div>
                    Description: {!!$event->event_description!!}     <br>
                    Start: {{ $event->event_start }}         <br>
                    End: {{ $event->event_end }}           <br>
                    Attendees:   @foreach ($event->attendees as $attendee){{$attendee}}  @endforeach                                   
                </div>
            </div>
        </div>            
    </div> 
</div>
