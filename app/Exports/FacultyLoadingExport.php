<?php

namespace App\Exports;

use App\Models\Faculty;
use App\Models\CourseLoad;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FacultyLoadingExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Faculty',
            'Subjects',
        ];
    }

    public function map($faculty): array
    {
        // $facultySubject = [];
        $subjects = CourseLoad::where('faculty_id', $faculty->id)->get();

        if(count($subjects) < 1){
            $facultySubject = 'none';
        }else{
            foreach($subjects as $subject)[
                $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $subject->start_date),
                $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $subject->end_date),
                $facultySubject[] = [
                    $subject->title,
                    $start_date->format("D H:i") . ' to ' . $end_date->format("H:i"),
    
                ],
            ];
        }
        
        
        
        return [
            $faculty->name,
            $facultySubject
            
        ];

    }

    public function collection()
    {
        return Faculty::with('courseload')->get();
    }
}
