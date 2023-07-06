<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\CourseLoad;
use App\Models\Curriculum;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CourseLoadingViewExportAll implements FromView, ShouldAutoSize
{
    use Exportable;

    private $id;
    private $period;

    // public function __construct(string $id, string $period)
    // {
    //     $this->id = $id;
    //     $this->period = $period;
    // }

    public function view(): View
    {
        // $faculty = Faculty::where('name', $request->facultyName)->first();
        
        // $courseload = Courseload::where('curriculum_id', $this->id)
        //                         ->where('period', $this->period)   
        //                         ->orderBy('start_date', 'asc')         
        //                         ->get();

        $courseload = Courseload::all();

        foreach ($courseload as $cl) {
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $cl->start_date);
            $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $cl->end_date);
            $subjects = Subject::where('id', $cl->subject_id)->first(); // does relation not working?
            $faculty = Faculty::where('id', $cl->faculty_id)->first(); // does it not really?
            $curriculum = Curriculum::where('id', $cl->curriculum_id)->first(); // wow, it really doesn't huh.
            $course = Course::where('id', $curriculum->course_id)->first(); // man this really looks ugly
            
            $subject[] = [
                'subject_code' => $subjects->subject_code,
                'subject_title' => $subjects->subject_title,
                'cred_units' => $subjects->cred_units,
                'subj_hours' => $subjects->subj_hours,
                'faculty' => $faculty->name,
                'day' => $start_date->format("D"),
                'start' => $start_date->format("h:i A"),
                'end' => $end_date->format("h:i A"),
                'program' => $course->course_code,
                'year' => $curriculum->level,
                'section' => $this->period,
                'room' => $cl->room
            ];
            // dd($subject);
            
        }

        return view('excel.courseloadviewall', [
            'subject' => $subject,
        ]);
    }
}
