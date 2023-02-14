<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\AssignmentApprovals;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FirstSheetBackupImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        // foreach ($rows as $row){
        //     AssignmentApprovals::create([
        //         'id' => $row[0],
        //         'faculty_id' => $row[1],
        //         'approval' => $row[2],
        //         'created_at' => $row[3],
        //         'updated_at' => $row[4]
        //     ]);
        // }

        if (!$row[0]){
            return;
        }

        return new AssignmentApprovals([
            'id' => $row[0],
            'faculty_id' => $row[1],
            'approval' => $row[2],
            'created_at' => $row[3],
            'updated_at' => $row[4]
        ]);
    }
}
