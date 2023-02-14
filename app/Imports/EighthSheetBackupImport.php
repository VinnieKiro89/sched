<?php

namespace App\Imports;

use App\Models\Subject;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EighthSheetBackupImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $collection)
    {
        foreach($collection as $col){
            Subject::create([
                'id' => $col['id'],
                'curriculum_id' => $col['curriculum_id'],
                'period' => $col['period'],
                'section' => $col['section'],
                'level' => $col['level'],
                'subject_code' => $col['subject_code'],
                'subject_title' => $col['subject_title'],
                'cred_units' => $col['cred_units'],
                'subj_hours' => $col['subj_hours'],
                'pre_requisite' => $col['pre_requisite'],
                'co_requisite' => $col['co_requisite'],
                // 'selectFaculty' => $col['selectFaculty'], DONT KNOW IF I WILL FIX
                'created_at' => $col['created_at'],
                'updated_at' => $col['updated_at'],
            ]);
        }
    }
}
