<?php

namespace App\Exports;

use App\Models\CourseLoad;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CourseLoadingExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Course',
            'Section',
            'Level',
            'Period',
            'Subject Code',
            'Start Date',
            'End Date',
        ];
    }

    public function map($courseload): array
    {
        // $facultySubject = [];
        // $subjects = CourseLoad::where('faculty_id', $faculty->id)->get();

        // if(count($subjects) < 1){
        //     $facultySubject = 'none';
        // }else{
        //     foreach($subjects as $subject)[
        //         $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $subject->start_date),
        //         $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $subject->end_date),
        //         $facultySubject[] = [
        //             $subject->title,
        //             $start_date->format("D H:i") . ' to ' . $end_date->format("H:i"),
    
        //         ],
        //     ];
        // }
        
        $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $courseload->start_date);
        $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $courseload->end_date);
        
        return [
            $courseload->curriculum->course->course_code,
            $courseload->curriculum->section,
            $courseload->curriculum->level,
            $courseload->period,
            $courseload->title,
            $start_date->format("D H:i"),
            $end_date->format("D H:i")
            
        ];

    }

    public function collection()
    {
        return CourseLoad::with('curriculum')->get();
    }
}
