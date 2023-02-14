<?php

namespace App\Imports;

use App\Models\Curriculum;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FourthSheetBackupImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $col){
            Curriculum::create([
                'id' => $col['id'],
                'course_id' => $col['course_id'],
                'level' => $col['level'],
                'section' => $col['section'],
                'created_at' => $col['created_at'],
                'updated_at' => $col['updated_at'],
            ]);
        }
    }
}
