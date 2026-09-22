@extends('layout')

@section('content')
    <style>
        .clickable-event {
            cursor: pointer;
        }
    </style>

    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Calendar Of Events' ])
    
        <section class="content">
            <div class="container-fluid">
                @include('components.message-notification')
                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-body small">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ URL::asset('admin-lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/plugins/fullcalendar/main.js') }}"></script>

    <script>
        $(function () {
            var date = new Date()
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear()
        
            var Calendar = FullCalendar.Calendar;
            var calendarEl = document.getElementById('calendar');
      
            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                events: {!! json_encode($events) !!},
                editable  : false,
                droppable : false,
                eventClick: function(event, jsEvent, view) {
                    window.location.href = `/welcome/administrator/reservations/info/${event.event.id}`;
                },
            });
        
            calendar.render();
        });
    </script>
@endsection