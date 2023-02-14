<?php

namespace App\Imports;

use App\Models\CourseLoad;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ThirdSheetBackupImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $col){
            CourseLoad::create([
               'id' => $col['id'],
               'curriculum_id' => $col['curriculum_id'],
               'period' => $col['period'],
               'title' => $col['title'],
               'start_date' => $col['start_date'],
               'end_date' => $col['end_date'],
               'room' => $col['room'],
               'faculty_id' => $col['faculty_id'],
               'subject_id' => $col['subject_id'],
               'created_at' => $col['created_at'],
               'updated_at' => $col['updated_at'],
            ]);
        }
    }
}
