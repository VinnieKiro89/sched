@extends('layouts.app')

@section('css')
    <style>
        .box {
            display: none;
        }

    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header" style="color:#606060">
            <h5 class="page__heading">View Faculty</h5>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session()->get('Role') == "Faculty")
                                <div class="d-flex justify-content-end">
                                    <button type="button"
                                        class="btn btn-success mr-5 user-edit"
                                        data-toggle="modal" data-target=".edit" data-uid="{{ $faculty->user_id }}" 
                                        data-num_of_subj="{{ $faculty->num_of_subj }}" data-hour_avail_from="{{ $faculty->hour_avail_from }}" 
                                        data-hour_avail_to="{{ $faculty->hour_avail_to }}">
                                        <i class="far fa-edit"></i>
                                        Set Number of Subjects willing to teach / Number of Hours willing to teach
                                    </button>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card shadow">
                                        <div class="card-header px-0">
                                            <span class="p-2 pl-4"
                                                style="background-color: #800000; width: 100%;">
                                                <h4 style="color:white; font-weight:400;">Personal Information</h4>
                                            </span>
                                        </div>
                                        <div class="card-header pb-20 " style="display: block;">
                                            <div class="img-part text-center">
                                                <img src="{{ asset('img/avatar-placeholder.png') }}" class="rounded-circle"
                                                    alt="Avatar" width="150px">
                                            </div>
                                            <div class="text" style="font-weight:600; font-size:18px; color:grey;">
                                                <h5 class="pt-3">{{ $faculty->name }}</h5>
                                                <p class="mb-0">Email: {{ $faculty->email }}</p>
                                                <p class="mb-0">Contact: {{ $faculty->contact }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="card-header px-0">
                                            <span class="p-2 pl-4"
                                                style="background-color: #800000; width: 100%;">
                                                <h4 style="color:white; font-weight:400;">Subjects and Time Availability</h4>
                                            </span>
                                        </div>
                                        <div class="card-body pb-0">
                                            <div class="text" style="font-weight:600; font-size:15px; color:grey;">
                                                <h6 class="mb-0">Subjects willing to teach:</h6>
                                                <p class="mb-0">{{ $faculty->num_of_subj }}</p>
                                                <p></p>
                                                <h6 class="mb-0">Day Availability:</h6>
                                                <p class="mb-0">
                                                    @php
                                                    // $datas = $faculty->day_avail;
                                                    $datas = json_decode($faculty->day_avail, true)
                                                    @endphp
                                                    
                                                    @if (isset($datas) && !empty($datas))
                                                    <p>
                                                        @foreach ($datas as $index => $data)
                                                        {{ e($data['text']) }}@if ($index < count($datas) - 1), @endif
                                                        @endforeach
                                                    </p>
                                                    @endif
                                                </p>
                                                <p></p>
                                                <h6 class="mb-0">Time availability:</h6>
                                                <p class="mb-0">{{ $faculty->hour_avail_from }} to {{ $faculty->hour_avail_to }}</p>
                                                <p></p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card shadow">
                                        <div class="card-header px-0">
                                            <span class="p-2 pl-4"
                                                style="background-color: #800000; width: 100%;">
                                                <h4 style="color:white; font-weight:400;">Educational Attainment</h4>
                                            </span>
                                        </div>
                                        <div class="card-body pb-0">
                                            <div class="text" style="font-weight:600; font-size:15px; color:grey;">
                                                <h6 class="mb-0">Undergraduate:</h6>
                                                <p class="mb-0">{{ $faculty->undergraduate }}</p>
                                                <p></p>
                                                <h6 class="mb-0">Graduate:</h6>
                                                <p class="mb-0">{{ $faculty->graduate }}</p>
                                                <p></p>
                                                <h6 class="mb-0">Post-graduate:</h6>
                                                <p class="mb-0">{{ $faculty->post_graduate }}</p>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="card-header px-0">
                                            <span class="p-2 pl-4"
                                                style="background-color: #800000; width: 100%;">
                                                <h4 style="color:white; font-weight:400;">Work background</h4>
                                            </span>
                                        </div>
                                        <div class="card-header pb-20 " style="display: block;">
                                            <div class="text" style="font-weight:600; font-size:18px; color:grey;">
                                                <h5 class="mb-0">Professional License:</h5>
                                                <p class="mb-0">{{ $faculty->professional_license }}</p>
                                                <p></p>
                                                <h5 class="mb-0">Name of Company:</h5>
                                                <p class="mb-0">{{ $faculty->name_of_company }}</p>
                                                <p></p>
                                                <h5 class="mb-0">Length of Teaching:</h5>
                                                <p class="mb-0">{{ $faculty->length_of_teaching }}</p>
                                                <p></p>
                                                <h5 class="mb-0">Field:</h5>
                                                <p class="mb-0">{{ $faculty->field }}</p>
                                                <p></p>
                                                <h5 class="mb-0">Subjects Taught:</h5>
                                                <p class="mb-0">{{ $faculty->subj_taught }}</p>
                                                <p></p>
                                                <h5 class="mb-0">Nature of Application:</h5>
                                                <p class="mb-0">{{ $faculty->nature_of_appt }}</p>
                                                <p></p>
                                                <h5 class="mb-0">Status:</h5>
                                                <p class="mb-0">{{ $faculty->status }}</p>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                 
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

    <!-- User Modal edit User-->
    <div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #033571;">Set available Subject / Hours</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="num_of_subj">Number of Subjects willing to teach:</label><span class="text-danger">*</span>
                                    <input id="num_of_subj" type="text"
                                        class="form-control{{ $errors->has('num_of_subj') ? ' is-invalid' : '' }}" name="num_of_subj"
                                        tabindex="1" placeholder="Set number of Subjects willing to teach" required autofocus>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('num_of_subj') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="dayArray">
                                <div class="form-group">
                                    <label for="co-requisite">Day Availability:</label>
                                    <!-- why do I need to use style for this ass select2 -->
                                    <select style="width:450px" class=" select2-multiple form-control"
                                        name="day_avail[]" multiple="multiple" id="select2-multiple">
                                        <option value="Mon">Monday</option>
                                        <option value="Tue">Tuesday</option>
                                        <option value="Wed">Wednesday</option>
                                        <option value="Thu">Thursday</option>
                                        <option value="Fri">Friday</option>
                                        <option value="Sat">Saturday</option>
                                        <option value="Sun">Sunday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role">Time Availability:</label><span class="text-danger">*</span>

                                    <select id="select1"
                                        class="form-control{{ $errors->has('hour_avail_from') ? ' is-invalid' : '' }}" name="hour_avail_from" required autofocus>

                                        <option value= "" selected disabled hidden>From:</option>
                                        <!-- this looks ugly -->
                                        <option value="6:00 AM">6:00 AM</option>
                                        <option value="6:30 AM">6:30 AM</option>
                                        <option value="7:00 AM">7:00 AM</option>
                                        <option value="7:30 AM">7:30 AM</option>
                                        <option value="8:00 AM">8:00 AM</option>
                                        <option value="8:30 AM">8:30 AM</option>
                                        <option value="9:00 AM">9:00 AM</option>
                                        <option value="9:30 AM">9:30 AM</option>
                                        <option value="10:00 AM">10:00 AM</option>
                                        <option value="10:30 AM">10:30 AM</option>
                                        <option value="11:00 AM">11:00 AM</option>
                                        <option value="11:30 AM">11:30 AM</option>
                                        <option value="12:00 PM">12:00 PM</option>
                                        <option value="12:30 PM">12:30 PM</option>
                                        <option value="1:00 PM">1:00 PM</option>
                                        <option value="1:30 PM">1:30 PM</option>
                                        <option value="2:00 PM">2:00 PM</option>
                                        <option value="2:30 PM">2:30 PM</option>
                                        <option value="3:00 PM">3:00 PM</option>
                                        <option value="3:30 PM">3:30 PM</option>
                                        <option value="4:00 PM">4:00 PM</option>
                                        <option value="4:30 PM">4:30 PM</option>
                                        <option value="5:00 PM">5:00 PM</option>
                                        <option value="5:30 PM">5:30 PM</option>
                                        <option value="6:00 PM">6:00 PM</option>
                                        <option value="6:30 PM">6:30 PM</option>
                                        <option value="7:00 PM">7:00 PM</option>
                                        <option value="7:30 PM">7:30 PM</option>
                                        <option value="8:00 PM">8:00 PM</option>
                                        <option value="8:30 PM">8:30 PM</option>
                                        <option value="9:00 PM">9:00 PM</option>
                                    </select>

                                    <select id="select1"
                                        class="form-control{{ $errors->has('hour_avail_to') ? ' is-invalid' : '' }}" name="hour_avail_to" required autofocus>

                                        <option value= "" selected disabled hidden>To:</option>
                                        <!-- this looks ugly -->
                                        <option value="6:00 AM">6:00 AM</option>
                                        <option value="6:30 AM">6:30 AM</option>
                                        <option value="7:00 AM">7:00 AM</option>
                                        <option value="7:30 AM">7:30 AM</option>
                                        <option value="8:00 AM">8:00 AM</option>
                                        <option value="8:30 AM">8:30 AM</option>
                                        <option value="9:00 AM">9:00 AM</option>
                                        <option value="9:30 AM">9:30 AM</option>
                                        <option value="10:00 AM">10:00 AM</option>
                                        <option value="10:30 AM">10:30 AM</option>
                                        <option value="11:00 AM">11:00 AM</option>
                                        <option value="11:30 AM">11:30 AM</option>
                                        <option value="12:00 PM">12:00 PM</option>
                                        <option value="12:30 PM">12:30 PM</option>
                                        <option value="1:00 PM">1:00 PM</option>
                                        <option value="1:30 PM">1:30 PM</option>
                                        <option value="2:00 PM">2:00 PM</option>
                                        <option value="2:30 PM">2:30 PM</option>
                                        <option value="3:00 PM">3:00 PM</option>
                                        <option value="3:30 PM">3:30 PM</option>
                                        <option value="4:00 PM">4:00 PM</option>
                                        <option value="4:30 PM">4:30 PM</option>
                                        <option value="5:00 PM">5:00 PM</option>
                                        <option value="5:30 PM">5:30 PM</option>
                                        <option value="6:00 PM">6:00 PM</option>
                                        <option value="6:30 PM">6:30 PM</option>
                                        <option value="7:00 PM">7:00 PM</option>
                                        <option value="7:30 PM">7:30 PM</option>
                                        <option value="8:00 PM">8:00 PM</option>
                                        <option value="8:30 PM">8:30 PM</option>
                                        <option value="9:00 PM">9:00 PM</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hour_avail_to') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection


@section('scripts')

<script>  // wat this for?
    $(document).ready(function() {

        $('.labtest_img').click(function() {
               $("#img").attr("src","/storage/"+$(this).data('labtest_path'));
        });

    });
</script>

<!-- edit script -->
<script>
    $(document).ready(function() {
        // $('option').val($(this).data('role')).attr('selected', 'selected');

        $('.user-edit').each(function() {
            $(this).click(function(event) {
                $('#update').attr("action", "/faculty/updateSubjTime/" + $(this).data('uid') + "");
                $('input[name="num_of_subj"]').val($(this).data('num_of_subj'));
                $('select[name="hour_avail_from"]').val($(this).data('hour_avail_from'));
                $('select[name="hour_avail_to"]').val($(this).data('hour_avail_to'));
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#select2-multiple').select2(
        {
            placeholder: 'Select Day',
            multiple: true,
            allowClear: true,
        });
    });
    
</script>

<script>
    $('#update').submit(function() {
        var dayArray = $('#select2-multiple').select2('data');
        var dayArrayString = JSON.stringify(dayArray);
        $('input[name="dayArray"]').val(dayArrayString);
    });
</script>

@endsection

