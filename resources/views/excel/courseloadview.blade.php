<table>
    <thead>
        <tr>
            <th style="font-weight:bold; text-align:center; border:3px solid black">Course Code</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">Title</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">Acad Unit</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">Lec/Lab Hours</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">Faculty</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">Day</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">Time</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">Section</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">Room</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($subject as $sub)
            <tr>
                <td style="border-left:2px solid black; border-right:2px solid black">{{ $sub['subject_code'] }}</td>
                <td style="border-right:2px solid black">{{ $sub['subject_title'] }}</td>
                <td style="border-right:2px solid black">{{ $sub['cred_units'] }}</td>
                <td style="border-right:2px solid black">{{ $sub['subj_hours'] }}</td>
                <td style="border-right:2px solid black; background-color:yellow">{{ $sub['faculty'] }}</td>
                <td style="border-right:2px solid black; background-color:yellow">{{ $sub['day'] }}</td>
                <td style="border-right:2px solid black; background-color:yellow">{{ $sub['start']}}-{{$sub['end'] }}</td>
                <td style="border-right:2px solid black">{{ $sub['section'] }}</td>
                <td style="border-right:2px solid black">{{ $sub['room'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>