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
                                        
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card shadow">
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
@endsection


@section('scripts')

<script>  
    $(document).ready(function() {

        $('.labtest_img').click(function() {
               $("#img").attr("src","/storage/"+$(this).data('labtest_path'));
        });

    });
</script>

@endsection

