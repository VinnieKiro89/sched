<head>
        {{-- Full Calendar :) --}}
        <link href='{{ asset('css/fullcalendar.css') }}' rel='stylesheet' />
        <script src='{{ asset('js/fullcalendar.js') }}'></script>
    
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" /> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> --}}
</head>

<div id='calendar'>tae</div>

<script>
    function loadcal(){
        console.log('IS THIS LOADCAL?')
        var calendarEl = document.getElementById('calendar');

        var subjects = @json($events);

        console.log(subjects);

        var calendar = new FullCalendar.Calendar(calendarEl, {});

        calendar.render();
        console.log('just making sure')
    };
</script>

<script>
    loadcal();
</script>
