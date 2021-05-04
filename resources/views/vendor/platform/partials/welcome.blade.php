    <div class="row admin-wrapper">
        <div class="container">
            <div class="row m-b-xl text-left">
                <div class="wrapper w-full">
                    <h1 class="text-success font-weight-bold  m-b-sm">
                        @php
                        echo(date('l'));
                        @endphp
                    </h1>
                    <h4 class="font-thin m-b-n">
                        @php
                        echo(date('F d, Y'));
                        @endphp
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

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
                    @foreach($events as $event) {
                        @php
                        $eventAttendees = '';
                        $attendees = App\User::find($event->attendees);
                        $i = 0;
                        $len = count($attendees);
                        foreach ($attendees as $user) {
                            if($i == $len - 1) {
                                $eventAttendees.=$user->name;
                            }else{
                                $eventAttendees.=$user->name.', ';
                            }
                            $i++;
                        }
                        @endphp
                        title: '{{ $event->event_title }}',
                        start: '{{ $event->event_start }}',
                        end: '{{ $event->event_end }}',
                        extendedProps: {
                            description: '{{ $event->event_description }}',
                            attendees: '{{ $eventAttendees }}'
                        },
                    },
                    @endforeach
                ],
            });
            calendar.render();
        }
    });
</script>
