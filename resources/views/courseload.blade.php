@extends('layouts.app')

@section('content')
<section class='section'>
    <div class='section-header' style="color:#606060">
        <h5 class="page__heading">Course Loading</h5>
    </div>
    
    <section class='section-body'>
      <div class="row">
        <div class="col-lg-4" id="tite">
          <div class="card shadow">
            <div class="card-body">
              <h5>Subject List</h5>
              <div class="form-group">
                <label for="email">Subject Title:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="select1" class="form-control" placeholder="Enter Course" name="course" required autofocus>
                      <option value="" selected disabled hidden>Select Title</option>
                      @foreach ($subjects as $subject)
                          <option value="{{ $subject->subject_code }}">
                              {{ $subject->subject_title }}
                          </option>
                      @endforeach
                  </select>
                </div>
                <label for="email">Start Time:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="select1" class="form-control" placeholder="Enter Course" name="course" required autofocus>
                      <option value="" selected disabled hidden>Select Day</option>
                      <!-- this looks ugly -->
                      <option value="Sun">Sunday</option>
                      <option value="Mon">Monday</option>
                      <option value="Tue">Tueday</option>
                      <option value="Wed">Wedday</option>
                      <option value="Thu">Thuday</option>
                      <option value="Fri">Friday</option>
                      <option value="Sat">Satday</option>
                  </select>
                </div>
                <label for="email">Start Time:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="select1" class="form-control" placeholder="Enter Course" name="course" required autofocus>
                      <option value="" selected disabled hidden>Select Time</option>
                      <!-- this looks ugly -->
                      <option value="06:00:00">6:00 AM</option>
                      <option value="07:00:00">7:00 AM</option>
                      <option value="08:00:00">8:00 AM</option>
                      <option value="09:00:00">9:00 AM</option>
                      <option value="10:00:00">10:00 AM</option>
                      <option value="11:00:00">11:00 AM</option>
                      <option value="12:00:00">12:00 PM</option>
                      <option value="13:00:00">1:00 PM</option>
                      <option value="14:00:00">2:00 PM</option>
                      <option value="15:00:00">3:00 PM</option>
                      <option value="16:00:00">4:00 PM</option>
                      <option value="17:00:00">5:00 PM</option>
                      <option value="18:00:00">6:00 PM</option>
                      <option value="19:00:00">7:00 PM</option>
                      <option value="20:00:00">8:00 PM</option>
                      <option value="21:00:00">9:00 PM</option>
                  </select>
                </div>
                <label for="email">End Time:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="select1" class="form-control" placeholder="Enter Course" name="course" required autofocus>
                      <option value="" selected disabled hidden>Select Time</option>
                      <!-- there's probably a cleaner option to do this -->
                      <option value="06:00:00">6:00 AM</option>
                      <option value="07:00:00">7:00 AM</option>
                      <option value="08:00:00">8:00 AM</option>
                      <option value="09:00:00">9:00 AM</option>
                      <option value="010:00:00">10:00 AM</option>
                      <option value="011:00:00">11:00 AM</option>
                      <option value="12:00:00">12:00 PM</option>
                      <option value="13:00:00">1:00 PM</option>
                      <option value="14:00:00">2:00 PM</option>
                      <option value="15:00:00">3:00 PM</option>
                      <option value="16:00:00">4:00 PM</option>
                      <option value="17:00:00">5:00 PM</option>
                      <option value="18:00:00">6:00 PM</option>
                      <option value="19:00:00">7:00 PM</option>
                      <option value="20:00:00">8:00 PM</option>
                      <option value="21:00:00">9:00 PM</option>
                  </select>
                </div>
                <div class="footer">
                  <button type="button" class="btn btn-secondary">Clear</button>
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card shadow">
            <div class="card-body">
              <div class="">
                <div class="row row-cols-3">
                  <div class="form-group col">
                    <label for="email">Course:</label><span class="text-danger">*</span>
                    <div class="select w-100 mb-3">
                      <select id="course" class="form-control w-100" placeholder="Enter Course" name="course" required autofocus>
                          <option value="" selected disabled hidden>Select Course</option>
                          @foreach ($courses as $course)
                              <option value="{{ $course->id }}">
                                  {{ $course->id }}-{{ $course->course_code }}
                              </option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="email">Period:</label><span class="text-danger">*</span>
                    <div class="select w-100 mb-3">
                      <select id="period" class="form-control w-100" placeholder="Enter Course" name="period" required autofocus>
                          <option value="" selected disabled hidden>Select Period</option>
                          <option value="1st Semester">1st Semester</option>
                          <option value="2nd Semester">2nd Semester</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="email">Level:</label><span class="text-danger">*</span>
                    <div class="select w-100 mb-3">
                      <select id="level" class="form-control w-100" placeholder="Enter Course" name="level" required autofocus>
                          <option value="" selected disabled hidden>Select Level</option>                          
                          <option value="1st Year">1st Year</option>
                          <option value="2nd Year">2nd Year</option>
                          <option value="3rd Year">3rd Year</option>
                          <option value="4th Year">4th Year</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
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
          right: ''
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
            text: 'Save',
            click: function() {
              alert('clicked custom button 1!');
            }
          },
          custom2: {
            text: 'Cancel',
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

<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
    $(document).on('change', '#course', function(){
      var course = $('#course').val();
      var period = $('#period').val();
      var level = $('#level').val();

      console.log(course, period, level);

      $.ajax({
        type: 'get',
        url: '{{ route('courseload.get') }}',
        data: {'course':course, 'period':period, 'level':level},
        success: function(data){
          // console.log(data);
          $('#tite').html(data);
        },
      });
    });

  });

</script>


@endsection