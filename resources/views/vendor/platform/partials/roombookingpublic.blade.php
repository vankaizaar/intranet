<div class="container">
    <div class="row m-b-xl text-left">
        <div class="wrapper w-full">
        @if($roombookings->isEmpty())
            <a class="btn btn-block btn-danger">No scheduled bookings</a>
            @else
            <div class="row">
                <div class="col">                    
                <div id='calendar'></div>
                    <script>
                        $(document).ready(function () {
                            if ($('#calendar').length > 0) {
                                var calendarEl = document.getElementById('calendar');

                                var calendar = new Calendar(calendarEl, {
                                    plugins: [interaction, dayGrid, timeGrid, list],
                                    defaultView: 'dayGridMonth',
                                    defaultDate: '{{$today}}',
                                    eventLimit: true,
                                    header: {
                                        left: 'prev',
                                        center: 'title',
                                        right: 'next'
                                    },
                                    eventRender: function (info) {
                                        var description = info.event.extendedProps.description;
                                        var attendees = info.event.extendedProps.attendees;                    
                                        var tooltip = new Tooltip(info.el, {
                                            html:true,                        
                                            title: info.event.title,
                                            template:'<div class="tooltip text-left shadow"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner"></div><p class="tooltip-inner-description-title">Description</p><p class="tooltip-inner-description">'+description+'</p><p class="tooltip-inner-attendees-title">Attendees</p><p class="tooltip-inner-attendees">'+attendees+'</p><p class="tooltip-inner-time-title">Start</p><p class="tooltip-inner-start-time">'+info.event.start+'</p><p class="tooltip-inner-time-title">End</p><p class="tooltip-inner-end-time">'+info.event.end+'</p></div>',
                                            placement: 'top',
                                            trigger: 'hover',
                                            container: 'body'
                                        }); 
                                    },
                                    events: [
                                        @foreach($roombookings as $roombooking) {
                                            @php
                                            $meetingAttendees = '';
                                            $attendees = App\User::find($roombooking->attendees);
                                            $i = 0;
                                            $len = count($attendees);
                                            foreach ($attendees as $user) {                            
                                                if($i == $len - 1) {
                                                    $meetingAttendees.=$user->name;
                                                }else{
                                                    $meetingAttendees.=$user->name.', ';
                                                }
                                                $i++;
                                            }                     
                                            @endphp
                                            title: '{{ $roombooking->title }}',
                                            start: '{{ $roombooking->start_time }}',
                                            end: '{{ $roombooking->end_time }}',
                                            extendedProps: {
                                                description: '{{$roombooking->description}}',
                                                attendees: '{{ $meetingAttendees }}'
                                            }, 
                                        },
                                        @endforeach

                                    ],

                                });

                                calendar.render();
                            }
                        });

                    </script>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
