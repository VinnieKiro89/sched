@extends('layouts.app')

@section('content')
<section class='section'>

    <div class='section-header' style="color:#606060">
        <h5 class="page__heading">Approval</h5>
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
              <h5>Faculty Load List</h5>
              <div class="form-group">
                {{-- <input id="curriculum_id" value="" type="text" class="form-control{{ $errors->has('curriculum_id') ? ' is-invalid' : '' }}" name="curriculum_id" hidden readonly>
                <input id="realperiod" value="" type="text" class="form-control{{ $errors->has('realperiod') ? ' is-invalid' : '' }}" name="realperiod" hidden readonly> --}}
                <label for="email">Faculty Loads waiting for approval:</label><span class="text-danger">*</span>
                <div class="select mb-3">
                  <select id="selectFaculty" class="form-control" name="selectFaculty" required autofocus>
                      <option value="" selected disabled hidden>Select Faculty Load</option>
                      @foreach ($approvals as $approval)
                        <option> {{ $approval->faculty->name }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="footer">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card shadow">
            <div class="card-body">
              <div class="">
              </div>
              <div id='forcal'>
                <div id='calendar'></div>
              </div>
              <div class="footer text-right">
                <button id="decline" name="decline" type="button" class="btn btn-danger">Decline</button>
                <button id="approve" name="approve" type="button" class="btn btn-success">Approve</button>
              </div>
            </div>
          </div>
        </div>
      </div>
        
    </section> 

</section>
@endsection

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

      console.log(subjects);

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
        // eventClick:function(info)
        // {
        //   $('#edit').modal('show');
        //   var id = info.event.id;
        //   var title = info.event.title;
        //   var faculty = info.event.period;
        //   var faculty2 = info.event.description;

        //   var start_date = moment(info.event.start).format();
        //   var end_date = moment(info.event.end).format();
          
        //   var course = $('#course').val();
        //   var section = $('#section').val();
        //   var level = $('#level').val();
        //   var period = $('#period').val();

          
        //   // $('#edit').attr("action", "/courseload/update/" + id + "");
          

        //   $.ajax({
        //     type: 'get',
        //     url: '{{ route('courseload.get') }}',
        //     data: {'course':course, 'section':section, 'level':level, 'period':period},
        //     dataType: 'json',
        //     success: function(result){
        //       console.log(faculty);
        //       console.log(faculty2);
        //       // $('#update').attr("action", "/courseload/update/" + id + "");
        //       $('#selectTitleModal').html('<option value="" hidden>Select Title</option>');
        //       $.each(result.events, function (key, value) {
        //         $("#selectTitleModal").append('<option value="' + value.subject_code + '">' + value.subject_code + " - " + value.subject_title + '</option>');
        //         $('input[name="event_idModal"]').val(id);
        //         $('input[name="event_startModal"]').val(start_date);
        //         $('input[name="event_endModal"]').val(end_date);
        //         $('select[name="selectTitleModal"]').val(title);
        //         $('select[name="selectFacultyModal"]').val(faculty);
        //         $('input[name="curriculum_idModal"]').val(value.curriculum_id); 
        //         $('input[name="realperiodModal"]').val(value.period);
        //       });
        //     },
        //   });

        //   $('#deleteModal').click(function(){
        //     if(confirm("Are you sure you want to delete this event?"))
        //     {
        //       $.ajax
        //       ({ 
        //           url: "{{ route('courseload.destroy', '') }}" +'/'+ id,
        //           type:"DELETE",
        //           dataType: 'json',
        //           success: function(response) 
        //           {
        //             var id = response
        //             console.log(id)
        //               alert('Deleted!');

        //               //calendar.refetchEvents(); // remove this

        //               info.event.remove(); // try this instead

        //               $('#edit').modal('hide');
        //           },
        //           error: function(error)
        //           {
        //             console.log(error)
        //           }
        //       });
        //     };
        //   });

        //   $('#updateModal').click(function(e){
        //     e.preventDefault();

        //     var id = $('#event_idModal').val();
        //     var newTitle = $('#selectTitleModal').val();
        //     var newFaculty = $('#selectFacultyModal').val();
        //     var start_date = $('#event_startModal').val();
        //     var end_date = $('#event_endModal').val();

        //     $.ajax({ 
        //         method: 'PUT',
        //         url: $('#update').data('url'),
        //         data: { 'id':id, 'newTitle':newTitle, 'newFaculty':newFaculty, 'start_date':start_date, 'end_date':end_date },
        //         dataType: 'json',
        //         success: function(response) 
        //         {
        //           console.log(response)
        //           alert('Updated!');

        //           $('#edit').modal('hide');
        //         },
        //         error: function(error)
        //         {
        //           console.log(error)
        //         }
        //     });
        //   });

        // },
        selectable: false,
        editable: false,
        // eventDrop: function(info) {
        //   var id = info.event.id;
        //   var start_date = moment(info.event.start).format();
        //   var end_date = moment(info.event.end).format();

        //   $.ajax
        //   ({
        //     type: 'PATCH',
        //     url: "{{ route('courseload.update', '') }}" +'/'+ id,
        //     data: { 'start_date':start_date, 'end_date':end_date },
        //     dataType: 'json',

        //     success: function(response)
        //     {
        //       console.log(response);
        //     }
        //   })
        // },
        // eventResize: function(info) 
        // {
        //   var id = info.event.id;
        //   var curriculum_id = info.event.extendedProps.curriculum_id;
        //   var title = info.event.title;
        //   var start_date = moment(info.event.start).format();
        //   var end_date = moment(info.event.end).format();

        //   $.ajax
        //   ({
        //     type: 'PATCH',
        //     url: "{{ route('courseload.update', '') }}" +'/'+ id,
        //     data: { 'start_date':start_date, 'end_date':end_date },
        //     dataType: 'json',

        //     success: function(response)
        //     {
        //       console.log(response);
        //       console.log(curriculum_id);
              
        //     }
        //   })
        // },
        // eventsSet: function(events)
        // {
        //   console.log('hi', events)
        //   calendar.refetchEvents();
        //   calendar.render();
        // },
        droppable: false,
        eventOverlap: false,
        selectOverlap: false,
        select: function(start, end, allDays) {
        },
      });
      calendar.render();
    });
</script>

<!-- For changing calendar -->
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
        url: '{{ route('faculty.facultyLoad') }}',
        data: { 'faculty':faculty },
        dataType: 'json',
        success: function(data){
          calendar.removeAllEvents()
          calendar.addEventSource({
            events: data,
            eventRender: function(event, element) { 
              element.find('.fc-title').append('<br/><span class="fc-description">' + event.extendedProps.description); 
            },
          });
        },
      });
    });
  });
</script>

<!-- For populating dropdown -->
<!-- do I need this? -->

{{-- <script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function(){
    $('#selectFaculty').change(function(){

      $.ajax({
        type: 'get',
        url: '{{ route('approval.recall') }}',
        dataType: 'json',
        success: function(result){
          console.log(result)
          $('#selectFaculty').html('<option value="" hidden>Select Faculty Load</option>');
          $.each(result, function (i, element) {
            $("#selectFaculty").append($('<option>', {
              value: element.name,
              text: element.name,
            }));
          });
        },
      });
    });
  });

</script> --}}

<!-- For approving -->
<script type="text/javascript">
  $('#approve').click(function(e){
    e.preventDefault(); // do I need this?

    var faculty = $('#selectFaculty').val();

    $.ajax({ 
      method: 'PUT',
      url: '{{ route('approval.approve') }}',
      data: { 'faculty':faculty },
      success: function(response) 
      {
        console.log(response);
        alert('Approved')

        // to recall
        $.ajax({
          type: 'get',
          url: '{{ route('approval.recall') }}',
          dataType: 'json',
          success: function(result){
            console.log(result)
            // $('#selectFaculty').html('<option value="" hidden>Select Faculty Load</option>');
            if (result == null) {
              $('#selectFaculty').html('<option value="" hidden>Select Faculty Load</option>');
            } else {
              $('#selectFaculty').html('<option value="" hidden>Select Faculty Load</option>');
              $.each(result, function (i, element) {
                $("#selectFaculty").append($('<option>', {
                  value: element.name,
                  text: element.name,
                }));
              });
            }
            
            calendar.removeAllEvents()
          },
          error: function(error)
          {
            console.log(error)
          }
        });

      },
      error: function(error)
      {
        console.log(error)
        alert(error);
      }
    });

  });
</script>


<!-- For declining -->
<script>
  $('#decline').click(function(e){
    e.preventDefault(); // do I need this?

    var faculty = $('#selectFaculty').val();

    $.ajax({ 
      method: 'PUT',
      url: '{{ route('approval.decline') }}',
      data: { 'faculty':faculty },
      success: function(response) 
      {
        console.log(response);
        alert('Declined')

        $.ajax({
          type: 'get',
          url: '{{ route('approval.recall') }}',
          dataType: 'json',
          success: function(result){
            console.log(result)
            // $('#selectFaculty').html('<option value="" hidden>Select Faculty Load</option>');
            if (result == null) {
              $('#selectFaculty').html('<option value="" hidden>Select Faculty Load</option>');
            } else {
              $('#selectFaculty').html('<option value="" hidden>Select Faculty Load</option>');
              $.each(result, function (i, element) {
                $("#selectFaculty").append($('<option>', {
                  value: element.name,
                  text: element.name,
                }));
              });
            }
            
            calendar.removeAllEvents()
          },
          error: function(error)
          {
            console.log(error)
          }
        });

      },
      error: function(error)
      {
        console.log(error)
        alert(error);
      }
    });

  });
</script>


@endsection