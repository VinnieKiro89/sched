@extends('layouts.app')

@section('content')
<section class='section'>
    <div class='section-header' style="color:#606060">
        <h5 class="page__heading">Course Loading</h5>
    </div>
    
    <section class='section-body'>
      <div class="row">
        <div class="col-lg-4">
          <div class="card shadow">
            <div class="card-body">
              <h5>Course List</h5>
              <div >

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card shadow">
            <div class="card-body">
              <div id='calendar'></div>
            </div>
          </div>
        </div>
      </div>
        
    </section> 

</section>
@endsection

@section('scripts')
<script>

    // import resourceTimelinePlugin from '@fullcalendar/resource-timeline';
    // import interactionPlugin, { Draggable } from '@fullcalendar/interaction';
    
    

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      // var draggableEl = document.getElementById('mydraggable');

      // var containerEl = document.getElementById('draggable-el');
      var subjects = @json($subjects);

      console.log(subjects);

      // new Draggable(draggableEl);

      // new Draggable(containerEl, {
      //   itemSelector: '.item-class',
      //   eventData: function(eventEl) {
      //     return {
      //       title: eventEl.innerText,
      //       duration: '02:00'
      //     };
      //   }
      // });

      // $('#external-events .fc-event').each(function() {

      //   // store data so the calendar knows to render an event upon drop
      //   $(this).data('event', {
      //     title: $.trim($(this).text()), // use the element's text as the event title
      //     uniqueid: "XXX",
      //     stick: true, // maintain when user navigates (see docs on the renderEvent method)
      //     color : 'black',
      //     textColor: 'red' 
      //   });

      //   // make the event draggable using jQuery UI
      //   $(this).draggable({
      //     zIndex: 999,
      //     revert: true,      // will cause the event to go back to its
      //     revertDuration: 0,  //  original position after the drag
      //     //start: function (event, ui) {
      //     //alert("Salvare tuti i dati in variabile globale");
      //     //},
      //     //stop: function (event, ui) {
      //     //  alert(event);
      //     //}
      //   });

      //   });

      var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        
        initialView: 'timeGridFourDay',

        // resources: [

        //       { id: 'a', title: 'Sunday' },
        //       { id: 'b', title: 'Monday' },
        //       { id: 'c', title: 'Tuesday' },
        //       { id: 'd', title: 'Wednesday' },
        //       { id: 'e', title: 'Thursday' },
        //       { id: 'e', title: 'Friday' },
        //       { id: 'e', title: 'Saturday' },

        // ],
    
        headerToolbar: {
          left: '',
          center: '',
          right: ''
        },
        footerToolbar: {
          left: 'custom1,custom2',
          center: '',
          right: 'prev,next'
        },
        views: {
          timeGridFourDay: {
            // type: 'resourceTimeGridDay',
            type: 'timeGridWeek',
            slotMinTime: '6:00:00',
            slotMaxTime: '22:00:00',
            allDaySlot: false,
            expandRows: true,
            dayHeaderFormat: { weekday: 'long' },
          }
        },
        customButtons: {
          custom1: {
            text: 'custom 1',
            click: function() {
              alert('clicked custom button 1!');
            }
          },
          custom2: {
            text: 'custom 2',
            click: function() {
              alert('clicked custom button 2!');
            }
          }
        },
        events: [
          {
            title: 'Title',
            start: '2022-09-06T10:00:00+08:00',
            end: '2022-09-06T10:00:00+08:00'
          }
        ],
        selectable: true,
        selectHelper: true,
        editable: true,
        droppable: true,
        select: function(start, end, allDays) {
          console.log(start)
        } 
      });
      calendar.render();
      
    });

</script>


@endsection