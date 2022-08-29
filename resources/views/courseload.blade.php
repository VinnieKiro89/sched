@extends('layouts.app')

@section('content')
<section class='section'>
    <div class='section-header' style="color:#606060">
        <h5 class="page__heading">Course Loading</h5>
    </div>
    <section class='section-body'>
        <div id='calendar'>

        </div>
    </section> 
</section>
@endsection

@section('scripts')
<script>

    // import resourceTimelinePlugin from '@fullcalendar/resource-timeline';

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        
        initialView: 'timeGrid'
      });
      calendar.render();
    });

</script>
@endsection