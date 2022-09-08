@extends('layouts.app')

@section('content')
<section class='section'>
    <div class='section-header' style="color:#606060">
        <h5 class="page__heading">Course Loading</h5>
    </div>
    
    <section class='section-body'>

      @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session()->get('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif

      @if (session()->has('updated'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session()->get('updated') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif

      @if (session()->has('deleted'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session()->get('deleted') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif

      <div class="row">
        <div class="col-lg-4" id="title">
          <div class="card shadow">
            <div class="card-body">
              <h5>Subject List</h5>
              <div class="form-group">
                <input id="curriculum_id" value="" type="text" class="form-control{{ $errors->has('curriculum_id') ? ' is-invalid' : '' }}" name="curriculum_id" readonly>
                <label for="email">Subject Title:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="selectTitle" class="form-control" placeholder="Enter Course" name="course" required autofocus>
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
                  <select id="selectDay" class="form-control" placeholder="Enter Course" name="course" required autofocus>
                      <option value="" selected disabled hidden>Select Day</option>
                      <!-- this looks ugly -->
                      <option value="2022-09-04T">Sunday</option>
                      <option value="2022-09-05T">Monday</option>
                      <option value="2022-09-06T">Tuesday</option>
                      <option value="2022-09-07T">Wednesday</option>
                      <option value="2022-09-08T">Thursday</option>
                      <option value="2022-09-09T">Friday</option>
                      <option value="2022-09-10T">Saturday</option>
                  </select>
                </div>
                <label for="email">Start Time:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="selectStart" class="form-control" placeholder="Enter Course" name="course" required autofocus>
                      <option value="" selected disabled hidden>Select Time</option>
                      <!-- this looks ugly -->
                      <option value="06:00:00+08:00">6:00 AM</option>
                      <option value="07:00:00+08:00">7:00 AM</option>
                      <option value="08:00:00+08:00">8:00 AM</option>
                      <option value="09:00:00+08:00">9:00 AM</option>
                      <option value="10:00:00+08:00">10:00 AM</option>
                      <option value="11:00:00+08:00">11:00 AM</option>
                      <option value="12:00:00+08:00">12:00 PM</option>
                      <option value="13:00:00+08:00">1:00 PM</option>
                      <option value="14:00:00+08:00">2:00 PM</option>
                      <option value="15:00:00+08:00">3:00 PM</option>
                      <option value="16:00:00+08:00">4:00 PM</option>
                      <option value="17:00:00+08:00">5:00 PM</option>
                      <option value="18:00:00+08:00">6:00 PM</option>
                      <option value="19:00:00+08:00">7:00 PM</option>
                      <option value="20:00:00+08:00">8:00 PM</option>
                      <option value="21:00:00+08:00">9:00 PM</option>
                  </select>
                </div>
                <label for="email">End Time:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="selectEnd" class="form-control" placeholder="Enter Course" name="course" required autofocus>
                      <option value="" selected disabled hidden>Select Time</option>
                      <!-- there's probably a cleaner option to do this -->
                      <option value="06:00:00+08:00">6:00 AM</option>
                      <option value="07:00:00+08:00">7:00 AM</option>
                      <option value="08:00:00+08:00">8:00 AM</option>
                      <option value="09:00:00+08:00">9:00 AM</option>
                      <option value="10:00:00+08:00">10:00 AM</option>
                      <option value="11:00:00+08:00">11:00 AM</option>
                      <option value="12:00:00+08:00">12:00 PM</option>
                      <option value="13:00:00+08:00">1:00 PM</option>
                      <option value="14:00:00+08:00">2:00 PM</option>
                      <option value="15:00:00+08:00">3:00 PM</option>
                      <option value="16:00:00+08:00">4:00 PM</option>
                      <option value="17:00:00+08:00">5:00 PM</option>
                      <option value="18:00:00+08:00">6:00 PM</option>
                      <option value="19:00:00+08:00">7:00 PM</option>
                      <option value="20:00:00+08:00">8:00 PM</option>
                      <option value="21:00:00+08:00">9:00 PM</option>
                  </select>
                </div>
                <div class="footer">
                  <button type="button" class="btn btn-secondary">Clear</button>
                  <button id="save" name="save" type="submit" class="btn btn-primary">Save</button>
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

{{-- comment 
  // import resourceTimelinePlugin from '@fullcalendar/resource-timeline';
  // import interactionPlugin, { Draggable } from '@fullcalendar/interaction';
  // var draggableEl = document.getElementById('mydraggable');
  // var containerEl = document.getElementById('draggable-el');

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

  // resources: [

  //       { id: 'a', title: 'Sunday' },
  //       { id: 'b', title: 'Monday' },
  //       { id: 'c', title: 'Tuesday' },
  //       { id: 'd', title: 'Wednesday' },
  //       { id: 'e', title: 'Thursday' },
  //       { id: 'e', title: 'Friday' },
  //       { id: 'e', title: 'Saturday' },

  // ],

  --}}


@section('scripts')   
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var subjects = @json($events);

      console.log(subjects);

      var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        
        initialView: 'timeGridFourDay',
    
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
        events: subjects,
        selectable: true,
        selectHelper: true,
        editable: true,
        droppable: true,
        eventOverlap: false,
        select: function(start, end, allDays) {
          console.log(start)
        }, 
      });
      calendar.render();
    });
</script>

<script>
  $(document).ready(function(){
    $('#save').click(function() {
      var curriculum_id = $('#curriculum_id').val();
      var title = $('#selectTitle').val();
      var day = $('#selectDay').val();
      var start = $('#selectStart').val();
      var end = $('#selectEnd').val();
      

      var start_date = day + start;
      var end_date = day + end;
      console.log('before ajax')
      $.ajax({
        type: 'POST',
        url: '{{ route('courseload.post') }}',
        data: { 'curriculum_id':curriculum_id, 'title':title, 'day':day, 'start_date':start_date, 'end_date':end_date },

        success: function(response)
        {
          console.log('success')
          var calendarEl = document.getElementById('calendar');

          var subjects = @json($events);

          console.log(subjects);

          var calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            
            initialView: 'timeGridFourDay',
        
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
            events: subjects,
            selectable: true,
            selectHelper: true,
            editable: true,
            droppable: true,
            eventOverlap: false,
            select: function(start, end, allDays) {
              console.log(start)
            }, 
          });
          calendar.render();
          // FullCalendar.calendar('renderEvent', {
          //   'title'       : response.title,
          //   'start_date'  : response.start_date,
          //   'end_date'    : response.end_date,
          // });
        },
      });
    });
  });
</script>

<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
    $('#course, #level, #period').change(function(){
      var course = $('#course').val();
      var period = $('#period').val();
      var level = $('#level').val();

      $.ajax({
        type: 'get',
        url: '{{ route('courseload.get') }}',
        data: {'course':course, 'period':period, 'level':level},
        success: function(data){
          // console.log(data);
          $('#title').html(data);
        },
      });
    });

  });

</script>
 
<script>
  // Call the dataTables jQuery plugin
  // ok, so... wtf is this for??
  // $(document).ready(function() {
  //     $('#teachers-table').DataTable({
  //         "ordering": false
  //     });
  // });
</script>

@endsection