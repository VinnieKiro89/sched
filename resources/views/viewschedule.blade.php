@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="section-header" style="color:#606060">
            <h5>Assigned Schedule</h5>
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

                            <div id='forcal'>
                                <div id='calendar'></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                html: eventInfo.timeText + '<br/>' + eventInfo.event.title 
                            };
                        },
                    }
                },
                eventDidMount: function (event) {
                    $(event.el).attr('data-trigger', 'focus')
                    $(event.el).attr('tabindex', 0)
                },
                events: subjects,
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
@endsection