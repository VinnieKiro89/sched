<?php

namespace App\Imports;

use App\Models\Reports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SixthSheetBackupImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $col){
            Reports::create([
                'id' => $col['id'],
                'faculty_id' => $col['faculty_id'],
                'status' => $col['status'],
                'created_at' => $col['created_at'],
                'updated_at' => $col['updated_at'],
            ]);
        }
    }
}
