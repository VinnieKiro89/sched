@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="color:#606060">
            <h5>Old Course List</h5>
        </div>
        <div class="section-body">

            {{-- {{ Breadcrumbs::render('subject', $id) }} --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-body"> 

                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                    <h5> Old Course list for {{ $code }} {{ $level }} - {{ $section }} 1st Semester </h5>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <!-- Header goes here, i think -->
                                
                                <table class="table mt-4"
                                    style="width: 95%; color:black; border: 1px solid #800000; font-weight:700;">
                                    <thead style="background-color: #800000;">
                                        <tr>
                                            <th style="color:white;">Course Code</th>
                                            <th style="color:white;">Course Title</th>
                                            <th style="color:white;">Credited Units</th>
                                            <th style="color:white;">Course Hours</th>
                                            <th style="color:white;">Pre-requisite</th>
                                            <th style="color:white;">Co-requisite</th>
                                        </tr>
                                    </thead>
                                    <tbody>                    
                                        @foreach ($subjects as $subject)
                                            @if($subject->period == '1st Semester')
                                                <tr style="border: 1px solid #000000;">
                                                    <td>{{ $subject->subject_code }}</td>
                                                    <td>{{ $subject->subject_title }}</td>
                                                    <td>{{ $subject->cred_units }}</td>
                                                    <td>{{ $subject->subj_hours }}</td>
                                                    <td>{{ $subject->pre_requisite }}</td>
                                                    <td>{{ $subject->co_requisite }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Second Sem -->
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-body"> 

                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                    <h5> Old Course list for {{ $code }} {{ $level }} - {{ $section }} 2nd Semester </h5>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <!-- Header goes here, i think -->
                                
                                <table class="table mt-4"
                                    style="width: 95%; color:black; border: 1px solid #800000; font-weight:700;">
                                    <thead style="background-color: #800000;">
                                        <tr>
                                            <th style="color:white;">Course Code</th>
                                            <th style="color:white;">Course Title</th>
                                            <th style="color:white;">Credited Units</th>
                                            <th style="color:white;">Course Hours</th>
                                            <th style="color:white;">Pre-requisite</th>
                                            <th style="color:white;">Co-requisite</th>
                                        </tr>
                                    </thead>
                                    <tbody>                    
                                        @foreach ($subjects as $subject)
                                            @if($subject->period == '2nd Semester')
                                                <tr style="border: 1px solid #000000;">
                                                    <td>{{ $subject->subject_code }}</td>
                                                    <td>{{ $subject->subject_title }}</td>
                                                    <td>{{ $subject->cred_units }}</td>
                                                    <td>{{ $subject->subj_hours }}</td>
                                                    <td>{{ $subject->pre_requisite }}</td>
                                                    <td>{{ $subject->co_requisite }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Summer Sem -->
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-body"> 

                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                    <h5> Old Course list for {{ $code }} {{ $level }} - {{ $section }} Summer Semester </h5>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <!-- Header goes here, i think -->
                                
                                <table class="table mt-4"
                                    style="width: 95%; color:black; border: 1px solid #800000; font-weight:700;">
                                    <thead style="background-color: #800000;">
                                        <tr>
                                            <th style="color:white;">Course Code</th>
                                            <th style="color:white;">Course Title</th>
                                            <th style="color:white;">Credited Units</th>
                                            <th style="color:white;">Course Hours</th>
                                            <th style="color:white;">Pre-requisite</th>
                                            <th style="color:white;">Co-requisite</th>
                                        </tr>
                                    </thead>
                                    <tbody>                    
                                        @foreach ($subjects as $subject)
                                            @if($subject->period == 'Summer Semester')
                                                <tr style="border: 1px solid #000000;">
                                                    <td>{{ $subject->subject_code }}</td>
                                                    <td>{{ $subject->subject_title }}</td>
                                                    <td>{{ $subject->cred_units }}</td>
                                                    <td>{{ $subject->subj_hours }}</td>
                                                    <td>{{ $subject->pre_requisite }}</td>
                                                    <td>{{ $subject->co_requisite }}</td>
                                                </tr>
                                            @endif
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
@endsection