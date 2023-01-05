@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="section-header" style="color:#606060">
            <h5>Reports</h5>
        </div>
        <div class="section-body">

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
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-body">

                            <div class="d-flex justify-content-center">
                                <table class="table mt-4"
                                    style="width: 95%; color:black; border: 1px solid #800000; font-weight:700;">
                                    <thead style="background-color: #800000;">
                                        <tr>
                                            <th style="color:white;">Faculty Name</th>
                                            <th style="color:white;">Status</th>
                                            <th style="color:white;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $report)
                                            <tr style="border: 1px solid #000000;">
                                                <td>{{ $report->faculty->name }}</td>
                                                <td>{{ $report->status }}</td>
                                                    <td style="white-space:nowrap; width: 20px;">
                                                        <!-- I add 20px and it fix the extra space, don't know why | don't fix, don't change :) -->
                                                        {{-- <a href="#" class="btn btn-icon icon-left mr-3 btn-outline-primary">
                                                        <i class="far fa-edit"></i>
                                                        Edit</a> --}}

                                                        <a href="{{ route('reports.show', [$report->id]) }}" class="btn btn-icon icon-left mr-3 btn-outline-success">
                                                            <i class="fas fa-book"></i>
                                                            View Report
                                                        </a>

                                                        <!-- turn into 'Print' -->
                                                        {{-- <button type="button"
                                                            class="btn btn-icon icon-left mr-3 btn-outline-primary user-edit"
                                                            data-toggle="modal" data-target=".edit"
                                                            data-uid="{{ $course->id }}" data-course_code="{{ $course->course_code }}"
                                                            data-description="{{ $course->description }}">
                                                            <i class="far fa-edit"></i>
                                                            Edit
                                                        </button> --}}
                                                    </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarModalLabel">Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div id='forcal'>
                    <div id='calendar'></div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
      
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
                        eventDidMount: function (event) {
                            $(event.el).attr('data-trigger', 'focus')
                            $(event.el).attr('tabindex', 0)
                        },
                        selectable: false,
                        editable: false,
                        droppable: false,
                        eventOverlap: false,
                        selectOverlap: false,
                        select: function(start, end, allDays) {},
                    });
                    calendar.render();
                });
</script>

<script>
    $(document).ready(function() {
        $('.user-edit').each(function () {
            $(this).click(function(event){
                
            });
            
        });

        var faculty = $(this).data('faculty');

    });
</script>

{{-- <script type="text/javascript">
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
  </script> --}}
  
@endsection