<div class="card shadow">
    <div class="card-body">
      <h5>Subject List</h5>
      <div class="form-group">
        <label for="email">Subject Title:</label><span class="text-danger">*</span>
        <div class="select mb-3">
          <select id="select1" class="form-control" placeholder="Enter Course" name="course" required autofocus>
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
          <select id="select1" class="form-control" placeholder="Enter Course" name="course" required autofocus>
              <option value="" selected disabled hidden>Select Day</option>
              <!-- this looks ugly -->
              <option value="Sun">Sunday</option>
              <option value="Mon">Monday</option>
              <option value="Tue">Tueday</option>
              <option value="Wed">Wedday</option>
              <option value="Thu">Thuday</option>
              <option value="Fri">Friday</option>
              <option value="Sat">Satday</option>
          </select>
        </div>
        <label for="email">Start Time:</label><span class="text-danger">*</span>
        <div class="select mb-3">
          <select id="select1" class="form-control" placeholder="Enter Course" name="course" required autofocus>
              <option value="" selected disabled hidden>Select Time</option>
              <!-- this looks ugly -->
              <option value="06:00:00">6:00 AM</option>
              <option value="07:00:00">7:00 AM</option>
              <option value="08:00:00">8:00 AM</option>
              <option value="09:00:00">9:00 AM</option>
              <option value="10:00:00">10:00 AM</option>
              <option value="11:00:00">11:00 AM</option>
              <option value="12:00:00">12:00 PM</option>
              <option value="13:00:00">1:00 PM</option>
              <option value="14:00:00">2:00 PM</option>
              <option value="15:00:00">3:00 PM</option>
              <option value="16:00:00">4:00 PM</option>
              <option value="17:00:00">5:00 PM</option>
              <option value="18:00:00">6:00 PM</option>
              <option value="19:00:00">7:00 PM</option>
              <option value="20:00:00">8:00 PM</option>
              <option value="21:00:00">9:00 PM</option>
          </select>
        </div>
        <label for="email">End Time:</label><span class="text-danger">*</span>
        <div class="select mb-3">
          <select id="select1" class="form-control" placeholder="Enter Course" name="course" required autofocus>
              <option value="" selected disabled hidden>Select Time</option>
              <!-- there's probably a cleaner option to do this -->
              <option value="06:00:00">6:00 AM</option>
              <option value="07:00:00">7:00 AM</option>
              <option value="08:00:00">8:00 AM</option>
              <option value="09:00:00">9:00 AM</option>
              <option value="010:00:00">10:00 AM</option>
              <option value="011:00:00">11:00 AM</option>
              <option value="12:00:00">12:00 PM</option>
              <option value="13:00:00">1:00 PM</option>
              <option value="14:00:00">2:00 PM</option>
              <option value="15:00:00">3:00 PM</option>
              <option value="16:00:00">4:00 PM</option>
              <option value="17:00:00">5:00 PM</option>
              <option value="18:00:00">6:00 PM</option>
              <option value="19:00:00">7:00 PM</option>
              <option value="20:00:00">8:00 PM</option>
              <option value="21:00:00">9:00 PM</option>
          </select>
        </div>
        <div class="footer">
          <button type="button" class="btn btn-secondary">Clear</button>
          <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </div>
    </div>
  </div>