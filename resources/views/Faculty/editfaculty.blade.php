@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="color:#606060">
            <h5>Edit Faculty Member</h5>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <form method="POST" action="{{ route('faculty.update', $faculty->id ) }}" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="d-flex justify-content-center">
                                    <!-- Hidari -->
                                    <div class="col-lg-4">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <h5>Personal Information</h5>
                                                <div class="form-group">
                                                    <label for="name">Name:</label><span class="text-danger">*</span>
                                                    <input id="name" type="text"
                                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                                        tabindex="1" value="{{ $faculty->name }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email:</label><span class="text-danger">*</span>
                                                    <input id="email" type="email"
                                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                                        tabindex="1" value="{{ $faculty->email }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contact">Contact:</label><span class="text-danger">*</span>
                                                    <input id="contact" type="text"
                                                        class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact"
                                                        tabindex="1" value="{{ $faculty->contact }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('contact') }}
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Migi -->
                                    <div class="col-lg-8">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <h5>Educational Attainment</h5>
                                                <div class="form-group">
                                                    <label for="undergraduate">Undergraduate:</label><span class="text-danger">*</span>
                                                    <input id="undergraduate" type="text"
                                                        class="form-control{{ $errors->has('undergraduate') ? ' is-invalid' : '' }}" name="undergraduate"
                                                        tabindex="1" value="{{ $faculty->undergraduate }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('undergraduate') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="graduate">Graduate:</label><span class="text-danger">*</span>
                                                    <input id="graduate" type="text"
                                                        class="form-control{{ $errors->has('graduate') ? ' is-invalid' : '' }}" name="graduate"
                                                        tabindex="1" value="{{ $faculty->graduate }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('graduate') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="post_graduate">Post-Graduate:</label><span class="text-danger">*</span>
                                                    <input id="post_graduate" type="text"
                                                        class="form-control{{ $errors->has('post_graduate') ? ' is-invalid' : '' }}" name="post_graduate"
                                                        tabindex="1" value="{{ $faculty->post_graduate }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('post_graduate') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content">
                                    <div class="col-lg-12">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <h5>Work background</h5>
                                                <div class="form-group">
                                                    <label for="professional_license">Professional License:</label><span class="text-danger">*</span>
                                                    <input id="professional_license" type="text"
                                                        class="form-control{{ $errors->has('professional_license') ? ' is-invalid' : '' }}" name="professional_license"
                                                        tabindex="1" value="{{ $faculty->professional_license }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('professional_license') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name_of_company">Name of Company/Position:</label><span class="text-danger">*</span>
                                                    <input id="name_of_company" type="text"
                                                        class="form-control{{ $errors->has('name_of_company') ? ' is-invalid' : '' }}" name="name_of_company"
                                                        tabindex="1" value="{{ $faculty->name_of_company }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name_of_company') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="length_of_teaching">Length of Teaching experience:</label><span class="text-danger">*</span>
                                                    <input id="length_of_teaching" type="text"
                                                        class="form-control{{ $errors->has('length_of_teaching') ? ' is-invalid' : '' }}" name="length_of_teaching"
                                                        tabindex="1" value="{{ $faculty->length_of_teaching }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('length_of_teaching') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field">Field of Specialization:</label><span class="text-danger">*</span>
                                                    <input id="field" type="text"
                                                        class="form-control{{ $errors->has('field') ? ' is-invalid' : '' }}" name="field"
                                                        tabindex="1" value="{{ $faculty->field }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('field') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="subj_taught">Subjects Taught:</label><span class="text-danger">*</span>
                                                    <input id="subj_taught" type="text"
                                                        class="form-control{{ $errors->has('subj_taught') ? ' is-invalid' : '' }}" name="subj_taught"
                                                        tabindex="1" value="{{ $faculty->subj_taught }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('subj_taught') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nature_of_appt">Nature of Appointment:</label><span class="text-danger">*</span>
                                                    <input id="nature_of_appt" type="text"
                                                        class="form-control{{ $errors->has('nature_of_appt') ? ' is-invalid' : '' }}" name="nature_of_appt"
                                                        tabindex="1" value="{{ $faculty->nature_of_appt }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('nature_of_appt') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status:</label><span class="text-danger">*</span>
                                                    <input id="status" type="text"
                                                        class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status"
                                                        tabindex="1" value="{{ $faculty->status }}" autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('status') }}
                                                    </div>
                                                </div>                                          
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary mx-1" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary mx-1">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection