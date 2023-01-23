<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faculty Schedule</title>
    <style>
      #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }
      
      #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
      }
      
      #customers tr:nth-child(even){background-color: #f2f2f2;}
      
      /* #customers tr:hover {background-color: #ddd;} */
      
      #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #800000;
        color: white;
      }

      .header {
            display: -webkit-box; /* what the hell is a webkit box */
            display: -webkit-flex;
            display: flex;
            align-items: center;
        }

      .body {
        margin: 20px;
      }
      </style>
</head>
<body class="body">
  <div class="header">
    <img src="{{ public_path("/img/logo.jpg") }}" width="130px" alt=""/>
    <div style="margin: 10px">
      <p style="margin-bottom: 3px; ">Republic of the Philippines</p>
      <p style="margin-bottom: 3px; margin-top: 3px; font-size: 26px; font-weight: bold">Polytechnic University of the Philippines</p>
      <p style="margin-bottom: 3px; margin-top: 3px; font-size: 16px">OFFICE OF THE VICE PRESIDENT FOR BRANCHES AND SATTELITE CAMPUSES</p>
      <p style="margin-top: 3px; font-size: 21px; font-weight: bold">Calauan, Laguna Campus</p>
    </div>
  </div>

  <hr>
  <h3 style="font-size: 30px; text-align: center">Schedule for {{ $faculty->name }}</h3>
    <table id="customers">
        <tr>
          <th>Subject Code</th>
          <th>Description</th>
          <th>Units</th>
          <th>Hours</th>
          <th>Schedule</th>
        </tr>
        @foreach ($subject as $subj)
          <tr>
              <td>{{ $subj['subject_code'] }}</td>
              <td>{{ $subj['subject_title'] }}</td>
              <td>{{ $subj['cred_units'] }}</td>
              <td>{{ $subj['subj_hours'] }}</td>
              <td>{{ $subj['start'] }} to {{ $subj['end'] }}</td>
            {{-- @foreach ($courseload as $cl)
              <td>{{ $cl->subject->subject_code }}</td>
              <td>{{ $cl->subject->subject_title }}</td>
              <td>{{ $cl->subject->cred_units }}</td>
              <td>{{ $cl->subject->subj_hours }}</td>
              <td>{{ $cl->start_date }} to {{ $cl->end_date }}</td>
            @endforeach --}}
          </tr>
        @endforeach
    </table>
  <h6 style="font-size: 20px; text-align: center">For Approval only</h6>

  <footer>
    <p style="text-align: center">THE COUNTRY'S 1ST POLYTECHNICU</p>
  </footer>
</body>
</html>