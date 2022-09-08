<div class="card shadow">
  <div class="card-body">
    <h5>Subject List</h5>
    <div class="form-group">
      <input id="curriculum_id" value="{{ $curriculum->id }}" type="text" class="form-control{{ $errors->has('curriculum_id') ? ' is-invalid' : '' }}" name="curriculum_id" readonly>
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
      $.ajax({
        type: 'POST',
        url: '{{ route('courseload.post') }}',
        data: { 'curriculum_id':curriculum_id, 'title':title, 'day':day, 'start_date':start_date, 'end_date':end_date },

        success: function(response)
        {
          refetch();
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