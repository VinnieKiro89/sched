<table>
    <thead>
        <tr>
            <th style="font-weight:bold; text-align:center; border:3px solid black">SUBJ NO</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">TITLE</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">Lec/Lab Hours</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">FACULTY</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">ROOM</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">Start time</th>
            <th style="font-weight:bold; text-align:center; border:3px solid black">End time</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($subject as $sub)
            <tr>
                <td style="border-left:2px solid black; border-right:2px solid black">{{ $sub['subject_code'] }}</td>
                <td style="border-right:2px solid black">{{ $sub['subject_title'] }}</td>
                <td style="border-right:2px solid black">{{ $sub['subj_hours'] }}</td>
                <td style="border-right:2px solid black">{{ $sub['faculty'] }}</td>
                <td style="border-right:2px solid black">{{ $sub['room'] }}</td>
                <td style="border-right:2px solid black">{{ $sub['day']}}  {{ $sub['start']}}</td>
                <td style="border-right:2px solid black">{{ $sub['day']}}  {{$sub['end'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>