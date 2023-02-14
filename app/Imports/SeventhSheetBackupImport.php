<?php

namespace App\Imports;

use App\Models\ReportEvents;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SeventhSheetBackupImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $col){
            ReportEvents::create([
                'id' => $col['id'],
                'report_id' => $col['report_id'],
                'curriculum_id' => $col['curriculum_id'],
                'period' => $col['period'],
                'title' => $col['title'],
                'start_date' => $col['start_date'],
                'end_date' => $col['end_date'],
                'status' => $col['status'],
                'created_at' => $col['created_at'],
                'updated_at' => $col['updated_at'],
            ]);
        }
    }
}
