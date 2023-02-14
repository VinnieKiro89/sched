@extends('layouts.app')

@section('content')
<section class='section'>
    <div class='section-header' style="color:#606060">
        <h5 class="page__heading">Program Loading</h5>
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
              {{-- <h5>Course List</h5> --}}
              <div class="form-group">
                <input id="curriculum_id" value="" type="text" class="form-control{{ $errors->has('curriculum_id') ? ' is-invalid' : '' }}" name="curriculum_id" hidden readonly>
                <input id="realperiod" value="" type="text" class="form-control{{ $errors->has('realperiod') ? ' is-invalid' : '' }}" name="realperiod" hidden readonly>
                <label for="email">Course Title:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="selectTitle" class="form-control" name="selectTitle" required autofocus>
                      <option value="" selected disabled hidden>Select Title</option>
                  </select>
                </div>
                <label for="selectFaculty">Select Faculty:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="selectFaculty" class="form-control" name="selectFaculty" required autofocus>
                      <option value="" selected disabled hidden>Select Faculty</option>
                      @foreach ($faculties as $faculty)
                        <option value="{{ $faculty->id }}">
                          {{ $faculty->name }}
                        </option>
                      @endforeach
                  </select>
                </div>
                <label for="email">Day:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="selectDay" class="form-control" name="selectDay" required autofocus>
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
                <label for="selectStart">Start Time:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="selectStart" class="form-control" name="selectStart" required autofocus>
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
                <label for="selectEnd">End Time:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="selectEnd" class="form-control" name="selectEnd" required autofocus>
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
                <label for="selectRoom">Room:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="selectRoom" class="form-control" name="selectRoom" required autofocus>
                      <option value="" selected disabled hidden>Select Room</option>
                      <!-- there's probably a cleaner option to do this -->
                      <option value="Room 101">Room 101</option>
                      <option value="Room 102">Room 102</option>
                      <option value="Room 103">Room 103</option>
                      <option value="Room 104">Room 104</option>
                      <option value="Room 105">Room 105</option>
                      <option value="Room 201">Room 201</option>
                      <option value="Room 202">Room 202</option>
                      <option value="Room 203">Room 203</option>
                      <option value="Room 204">Room 204</option>
                      <option value="Room 205">Room 205</option>
                      <option value="Room 301">Room 301</option>
                      <option value="Room 302">Room 302</option>
                      <option value="Room 303">Room 303</option>
                      <option value="Room 304">Room 304</option>
                      <option value="Room 305">Room 305</option>
                      <option value="Comlab">Comlab</option>
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
                <div class="row row-cols-4">
                  <div class="form-group col">
                    <label for="email">Program:</label><span class="text-danger">*</span>
                    <div class="select w-100 mb-4">
                      <select id="course" class="form-control w-100" name="course" required autofocus>
                          <option value="" selected disabled hidden>Select Program</option>
                          @foreach ($courses as $course)
                              <option value="{{ $course->id }}">
                                  {{ $course->id }}-{{ $course->course_code }}
                              </option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="section">Section:</label><span class="text-danger">*</span>
                    <div class="select w-100 mb-4">
                      <select id="section" class="form-control w-100" name="section" required autofocus>
                          <option value="" selected disabled hidden>Select Section</option>
                          <option value="Section 1">Section 1</option>
                          <option value="Section 2">Section 2</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="email">Level:</label><span class="text-danger">*</span>
                    <div class="select w-100 mb-4">
                      <select id="level" class="form-control w-100" name="level" required autofocus>
                          <option value="" selected disabled hidden>Select Level</option>                          
                          <option value="1st Year">1st Year</option>
                          <option value="2nd Year">2nd Year</option>
                          <option value="3rd Year">3rd Year</option>
                          <option value="4th Year">4th Year</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="email">Period:</label><span class="text-danger">*</span>
                    <div class="select w-100 mb-4">
                      <select id="period" class="form-control w-100" name="period" required autofocus>
                          <option value="" selected disabled hidden>Select Period</option>                          
                          <option value="1st Semester">1st Semester</option>
                          <option value="2nd Semester">2nd Semester</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="">
                <div class="card shadow">
                  <div class="card-body">
                    <div class="row row-cols-3">
                      <span id="dayAvail" class="form-group col">
                        Day availability: -
                      </span>
                      <span id="timeAvail" class="form-group col">
                        Time availability: - to -
                      </span>
                      <span id="subjAvail" class="form-group col">
                        No. of Subjects willing to take: -
                      </span>
                      <span id="subjTaught" class="form-group col">
                        Subjects taught: -
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div id='forcal'>
                <div id='calendar'></div>
              </div>
              {{-- <button id="export" class="btn btn-success">Export data</button> --}}
              <a type="button" class="btn btn-success mr-5" href="{{ route('courseload.file-export') }}">Export data</a>
            </div>
          </div>
        </div>
      </div>
        
    </section> 
</section>

<!-- test modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="color: #033571;">Edit Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="update" enctype="multipart/form-data" method="POST"> 
        @csrf
        @method('PATCH')
        <div class="modal-body">
          <div class="row">
            <input id="event_idModal" value="" type="text" class="form-control" name="event_idModal" hidden readonly>
            <input id="event_startModal" value="" type="text" class="form-control" name="event_startModal" hidden readonly>
            <input id="event_endModal" value="" type="text" class="form-control" name="event_endModal" hidden readonly>
            <input id="curriculum_idModal" value="" type="text" class="form-control{{ $errors->has('curriculum_idModal') ? ' is-invalid' : '' }}" name="curriculum_idModal" hidden readonly>
            <input id="realperiodModal" value="" type="text" class="form-control{{ $errors->has('realperiodModal') ? ' is-invalid' : '' }}" name="realperiodModal" hidden readonly>
            <div class="col-md-12">
              <div class="form-group">
                <label for="email">Course Title:</label><span class="text-danger">*</span>
                <select id="selectTitleModal" name="selectTitleModal" class="form-control" placeholder="Enter Course" required autofocus>
                  <option value="" selected disabled hidden>Select Title</option>
                </select>
              </div>
            </div>
            {{-- <div class="col-md-12">
              <div class="form-group">
                <label for="day">Day:</label><span class="text-danger">*</span>
                <select id="selectDayModal" class="form-control" placeholder="Enter Course" name="course" required autofocus>
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
            </div> --}}
            <div class="col-md-12">
              <div class="form-group">
                <label for="course_code">Select Faculty:</label><span class="text-danger">*</span>
                <select id="selectFacultyModal" class="form-control" placeholder="Enter Course" name="selectFacultyModal" autofocus>
                  <option value="" selected disabled hidden>Select Faculty</option>
                  {{-- @foreach ($faculties as $faculty)
                    <option value="{{ $faculty->id }}">
                      {{ $faculty->name }}
                    </option>
                  @endforeach --}}
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="selectRoomModal">Select Room:</label><span class="text-danger">*</span>
                <select id="selectFacultyModal" class="form-control" placeholder="Enter Room" name="selectFacultyModal" autofocus>
                  <option value="" selected disabled hidden>Select Room</option>
                  <option value="Room 101">Room 101</option>
                  <option value="Room 102">Room 102</option>
                  <option value="Room 103">Room 103</option>
                  <option value="Room 104">Room 104</option>
                  <option value="Room 105">Room 105</option>
                  <option value="Room 201">Room 201</option>
                  <option value="Room 202">Room 202</option>
                  <option value="Room 203">Room 203</option>
                  <option value="Room 204">Room 204</option>
                  <option value="Room 205">Room 205</option>
                  <option value="Room 301">Room 301</option>
                  <option value="Room 302">Room 302</option>
                  <option value="Room 303">Room 303</option>
                  <option value="Room 304">Room 304</option>
                  <option value="Room 305">Room 305</option>
                  <option value="Comlab">Comlab</option>
                </select>
              </div>
            </div>
            {{-- <div class="col-md-12">
              <div class="form-group">
                <label for="course_code">Start Time:</label><span class="text-danger">*</span>
                <select id="selectStartModal" class="form-control" placeholder="Enter Course" name="course" required autofocus>
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
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="course_code">End Time:</label><span class="text-danger">*</span>
                <select id="selectEndModal" class="form-control" placeholder="Enter Course" name="course" required autofocus>
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
            </div> --}}
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="deleteModal" name="deleteModal" class="btn btn-danger">Delete</button>
          <button type="submit" id="updateModal" name="updateModal" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

<!-- what the hell is this for? -->
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
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var calendar;

    document.addEventListener('DOMContentLoaded', function() {
      

      var token = $("meta[name='scrf-token']").attr("content");

      var calendarEl = document.getElementById('calendar');

      var subjects = @json($events);

      // console.log(subjects);

      calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        
        initialView: 'timeGridFourDay',
        initialDate: '2022-09-05',

        // timeGridWeek: {
        //   eventRender: function(info) {
        //     var eventEl = info.el;

        //     var descriptionEl = document.createElement('div');
        //     descriptionEl.className = 'fc-description';
        //     descriptionEl.innerHTML = info.event.extendedProps.description;

        //     eventEl.appendChild(descriptionEl);
        //   }
        // },
    
        headerToolbar: {
          left: '',
          center: '',
          right: ''
        },
        footerToolbar: {
          left: '',
          center: '',
          right: ''
        },
        views: {
          timeGridFourDay: {
            type: 'timeGridWeek',
            slotMinTime: '6:00:00',
            slotMaxTime: '22:00:00',
            allDaySlot: false,
            expandRows: true,
            dayHeaderFormat: { weekday: 'long' },
            eventContent: function (eventInfo) {
              return {
                html: eventInfo.timeText + '<br/>' + eventInfo.event.title + '<br/>' + eventInfo.event.extendedProps.description
              };
            },
          }
        },
        // customButtons: {
        //   custom1: {
        //     text: 'Save',
        //     click: function() {
        //       alert('clicked custom button 1!');
        //     }
        //   },
        //   custom2: {
        //     text: 'Cancel',
        //     click: function() {
        //       alert('clicked custom button 2!');
        //     }
        //   }
        // },
        eventDidMount: function (event) {
            $(event.el).attr('data-trigger', 'focus')
            $(event.el).attr('tabindex', 0)
        },
        // events: subjects,
        eventClick:function(info)
        {
          $('#edit').modal('show');
          var id = info.event.id;
          var title = info.event.title;
          var faculty_id = info.event.extendedProps.faculty_id; 
          var faculty = info.event.extendedProps.description;

          var start_date = moment(info.event.start).format();
          var end_date = moment(info.event.end).format();
          
          var course = $('#course').val();
          var section = $('#section').val();
          var level = $('#level').val();
          var period = $('#period').val();

          
          // $('#edit').attr("action", "/courseload/update/" + id + "");
          

          $.ajax({
            type: 'get',
            url: '{{ route('courseload.getev') }}',
            data: {'title':title, 'course':course, 'section':section, 'level':level, 'period':period},
            dataType: 'json',
            success: function(result){
              // console.log(result);
              // console.log(info.event);
              // console.log(faculty);
              // console.log(faculty_id);

              var resultSubjects = result[0];
              var resultFaculty = result[1];
              
              $('#selectFacultyModal').html('<option value="" hidden>Select Faculty</option>');
              $.each(resultFaculty, function (i, element) {
                $("#selectFacultyModal").append($('<option>', {
                  value: element.id,
                  text: element.name,
                }));
              });

              $('#selectTitleModal').html('<option value="" hidden>Select Title</option>');
              $.each(resultSubjects, function (i, element) {
                $("#selectTitleModal").append($('<option>', {
                  value: element.subject_code,
                  text: element.subject_code + '-' + element.subject_title,
                }));
                $('input[name="event_idModal"]').val(id);
                $('input[name="event_startModal"]').val(start_date);
                $('input[name="event_endModal"]').val(end_date);
                $('select[name="selectTitleModal"]').val(title);
                $('select[name="selectFacultyModal"]').val(faculty_id);
                $('input[name="curriculum_idModal"]').val(element.curriculum_id); 
                $('input[name="realperiodModal"]').val(element.period);
              });
            },
          });

        },
        selectable: true,
        editable: true,
        eventDrop: function(info) {
          var id = info.event.id;
          var faculty = info.event.extendedProps.faculty_id
          var start_date = moment(info.event.start).format();
          var end_date = moment(info.event.end).format();

          var course = $('#course').val();
          var section = $('#section').val();
          var level = $('#level').val();
          var period = $('#period').val();

          $.ajax
          ({
            type: 'PATCH',
            url: "{{ route('courseload.update', '') }}" +'/'+ id,
            data: { 'faculty':faculty, 'start_date':start_date, 'end_date':end_date },
            dataType: 'json',

            success: function(response)
            {
              // console.log(response);
            },
            error: function(error){
              alert(error.responseJSON.error)
              $.ajax({
                type: 'get',
                url: '{{ route('courseload.getcal') }}',
                data: {'course':course, 'section':section, 'level':level, 'period':period},
                success: function(data){
                  // console.log(data);
                  
                  calendar.removeAllEvents();
                  calendar.addEventSource({
                    events: data,
                    eventRender: function(event, element) { 
                      element.find('.fc-title').append('<br/><span class="fc-description">' + event.extendedProps.description); 
                    },
                  });
                  

                },

              });
            }
          })
        },
        eventResize: function(info) 
        {
          var id = info.event.id;
          var curriculum_id = info.event.extendedProps.curriculum_id;
          var title = info.event.title;
          var faculty = info.event.extendedProps.faculty_id
          var start_date = moment(info.event.start).format();
          var end_date = moment(info.event.end).format();

          var course = $('#course').val();
          var section = $('#section').val();
          var level = $('#level').val();
          var period = $('#period').val();

          $.ajax
          ({
            type: 'PATCH',
            url: "{{ route('courseload.update', '') }}" +'/'+ id,
            data: { 'faculty':faculty, 'start_date':start_date, 'end_date':end_date },
            dataType: 'json',

            success: function(response)
            {
              // console.log(response);
              // console.log(curriculum_id);
            },
            error: function(error)
            {
              alert(error.responseJSON.error)
              $.ajax({
                type: 'get',
                url: '{{ route('courseload.getcal') }}',
                data: {'course':course, 'section':section, 'level':level, 'period':period},
                success: function(data){
                  // console.log(data);
                  
                  calendar.removeAllEvents();
                  calendar.addEventSource({
                    events: data,
                    eventRender: function(event, element) { 
                      element.find('.fc-title').append('<br/><span class="fc-description">' + event.extendedProps.description + event.extendedProps.room); 
                    },
                  });
                  

                },

              });
            }
          })
        },
        // eventsSet: function(events)
        // {
        //   console.log('hi', events)
        //   calendar.refetchEvents();
        //   calendar.render();
        // },
        droppable: true,
        eventOverlap: false,
        selectOverlap: false,
        select: function(start, end, allDays) {
        },
      });
      calendar.render();
    });
</script>

<!-- FOR SAVE -->
<script>
  $(document).ready(function(){
    $('#save').click(function() {
      var curriculum_id = $('#curriculum_id').val();
      var period = $('#realperiod').val();
      var title = $('#selectTitle').val();
      var day = $('#selectDay').val();
      var faculty = $('#selectFaculty').val();
      var start = $('#selectStart').val();
      var end = $('#selectEnd').val();
      var room = $('#selectRoom').val();
      
      var start_date = day + start;
      var end_date = day + end;

      if(start_date > end_date){
        alert('Incorrect Time')
      }else
      {
        $.ajax({
        type: 'POST',
        url: '{{ route('courseload.post') }}',
        data: { 
              'curriculum_id':curriculum_id, 
              'period':period, 
              'title':title, 
              'day':day, 
              'start_date':start_date, 
              'end_date':end_date,
              'room':room, 
              'faculty':faculty 
              },

        success: function(response)
        {
          // console.log(response)
          calendar.addEvent({
            'title': response.title,
            'subtitle': response.faculty,
            'start': response.start_date,
            'end': response.end_date,
          });
        
          var course = $('#course').val();
          var section = $('#section').val();
          var level = $('#level').val();
          var period = $('#period').val();

          // nested ajax, because re-initializing FC does not work.
          $.ajax({
            type: 'get',
            url: '{{ route('courseload.getcal') }}',
            data: {'course':course, 'section':section, 'level':level, 'period':period},
            success: function(data){
              // console.log(data);

              calendar.removeAllEvents();
              calendar.addEventSource(data)

            },

          });
        },
        error: function(error)
        {
          console.log(error)
          alert(error.responseJSON.error)
        }
        });

      }
    });
  });
</script>

<!-- FOR ONCHANGE SUBJECT LIST -->
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
    $('#course, #level, #section, #period').change(function(){
      var course = $('#course').val();
      var section = $('#section').val();
      var level = $('#level').val();
      var period = $('#period').val();

      $.ajax({
        type: 'get',
        url: '{{ route('courseload.get') }}',
        data: {'course':course, 'section':section, 'level':level, 'period':period},
        dataType: 'json',
        success: function(result){
          $('#selectTitle').html('<option value="" hidden>Select Title</option>');
          $.each(result.events, function (key, value) {
            $("#selectTitle").append('<option value="' + value.subject_code + '">' + value.subject_code + " - " + value.subject_title + '</option>');
            $('select[name="selectDay"]').val('');
            $('select[name="selectFaculty"]').val('');
            $('select[name="selectStart"]').val('');
            $('select[name="selectEnd"]').val('');
            $('input[name="curriculum_id"]').val(value.curriculum_id); 
            $('input[name="realperiod"]').val(value.period);
          });
        },
        error: function(error){
          // console.log(error);
          $('#selectTitle').html('<option value="" hidden>Select Title</option>');
        },
      });
    });
  });

</script>

<!-- FOR ONCHANGE CALENDAR -->
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
    $('#course, #level, #section, #period').change(function(){
      // $("#selectTitle").html('')
      var course = $('#course').val();
      var section = $('#section').val();
      var level = $('#level').val();
      var period = $('#period').val();

      calendar.removeAllEvents();

      $.ajax({
        type: 'get',
        url: '{{ route('courseload.getcal') }}',
        data: {'course':course, 'section':section, 'level':level, 'period':period},
        success: function(data){
          // console.log(data);
          

          // calendar.removeAllEvents();
          calendar.addEventSource({
            events: data,
            eventRender: function(event, element) { 
              element.find('.fc-title').append('<br/><span class="fc-description">' + event.extendedProps.description + event.extendedProps.room); 
            },
          });
          

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

<!-- FOR FACULTY PREFERENCE -->
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
    $('#selectTitle').change(function(){
      var title = $('#selectTitle').val();

      $.ajax({
        type: 'get',
        url: '{{ route('courseload.getpref') }}',
        data: {'title':title},
        success: function(result){
          $('#selectFaculty').html('<option value="" hidden>Select Faculty</option>');
          $.each(result, function (i, element) {
            $("#selectFaculty").append($('<option>', {
              value: element.id,
              text: element.name,
            }));
          });

        },

      });
    });
  });

</script>

<!-- FOR FACULTY PREFERENCE MODAL -->
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
    $('#selectTitleModal').change(function(){
      var title = $('#selectTitleModal').val();

      $.ajax({
        type: 'get',
        url: '{{ route('courseload.getpref') }}',
        data: {'title':title},
        success: function(result){
          $('#selectFacultyModal').html('<option value="" hidden>Select Faculty</option>');
          $.each(result, function (i, element) {
            $("#selectFacultyModal").append($('<option>', {
              value: element.id,
              text: element.name,
            }));
          });

        },

      });
    });
  });

</script>

<!-- FOR FACULTY PREFFER -->
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
    $('#selectFaculty').change(function(){
      var faculty = $('#selectFaculty').val();

      $.ajax({
        type: 'get',
        url: '{{ route('courseload.getfac') }}',
        data: {'faculty':faculty},
        success: function(result){
          console.log(result);
          if(result.day_avail == null){
            // do nothing lmao
          }else{
            var days = JSON.parse(result.day_avail);
            var dayTexts = [];
            for (var i = 0; i < days.length; i++) {
              dayTexts.push(days[i]['id']);
            }

            $('#dayAvail').html("Day availability: " + dayTexts.join(', '));
          }
          if(result.hour_avail_from == null){
            // do nothing lmao
          }else{
            $('#timeAvail').html("Time availability: " + result.hour_avail_from + " to " + result.hour_avail_to );
          }
          if(result.num_of_subj == null){
            // do nothing lmao
          }else{
            $('#subjAvail').html("No. of Subjects willing to take: " + result.num_of_subj);
          }
          
          $('#subjTaught').html("Subjects taught: " + result.subj_taught);

        },

      });
    });
  });

</script>

<!-- FOR DELETE MODAL -->
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
    $('#deleteModal').click(function(){
      var id = $('#event_idModal').val();
      var course = $('#course').val();
      var section = $('#section').val();
      var level = $('#level').val();
      var period = $('#period').val();

      if(confirm("Are you sure you want to delete this event?"))
      {
        $.ajax
        ({ 
            url: "{{ route('courseload.destroy', '') }}" +'/'+ id,
            type:"DELETE",
            dataType: 'json',
            success: function(response) 
            {
              var id = response
              // console.log(id)
                alert('Deleted!');

                //calendar.refetchEvents(); // remove this

                // try this instead
                // until we can find a simple calendar.removeEvent(id), we have to use this s#%t method
                $.ajax({
                  type: 'get',
                  url: '{{ route('courseload.getcal') }}',
                  data: {'course':course, 'section':section, 'level':level, 'period':period},
                  success: function(data){
                    // console.log(data);
                    
                    calendar.removeAllEvents();
                    calendar.addEventSource({
                      events: data,
                      eventRender: function(event, element) { 
                        element.find('.fc-title').append('<br/><span class="fc-description">' + event.extendedProps.description + event.extendedProps.room); 
                      },
                    });
                    

                  },

                });

                $('#edit').modal('hide');
            },
            error: function(error)
            {
              console.log(error)
            }
        });
      };
    });
  });
</script>

<!-- FOR UPDATE MODAL -->
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
    $('#updateModal').click(function(e){
      e.preventDefault();

      // $.ajaxSetup({
      //   headers: {
      //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   }
      // });

      var id = $('#event_idModal').val();
      var newTitle = $('#selectTitleModal').val();
      var newFaculty = $('#selectFacultyModal').val();
      var newRoom = $('#selectRoomModal').val();
      var start_date = $('#event_startModal').val();
      var end_date = $('#event_endModal').val();

      var course = $('#course').val();
      var section = $('#section').val();
      var level = $('#level').val();
      var period = $('#period').val();

      $.ajax({ 
          method: 'PUT',
          url: "{{ route('courseload.update2', '') }}" +'/'+ id,
          data: {
                  'newTitle':newTitle, 
                  'newFaculty':newFaculty, 
                  'newRoom':newRoom,
                  'start_date':start_date, 
                  'end_date':end_date 
                },
          dataType: 'json',
          success: function(response) 
          {
            // console.log(response)
            alert('Updated!');

            // until we can find a working calendar.refetchEvents(), we have to use this s#%t method
            $.ajax({
              type: 'get',
              url: '{{ route('courseload.getcal') }}',
              data: {'course':course, 'section':section, 'level':level, 'period':period},
              success: function(data){
                // console.log(data);
                
                calendar.removeAllEvents();
                calendar.addEventSource({
                  events: data,
                  eventRender: function(event, element) { 
                    element.find('.fc-title').append('<br/><span class="fc-description">' + event.extendedProps.description + event.extendedProps.room); 
                  },
                });
                

              },

            });

            $('#edit').modal('hide');
          },
          error: function(error)
          {
            console.log(error)
            alert(error.responseJSON.error)
          }
      });
    });
  });
</script>

<!-- FOR EXPORT BUTTON -->
{{-- <script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
    $('#export').click(function(e){
      e.preventDefault();
    })
  });
</script> --}}

@endsection