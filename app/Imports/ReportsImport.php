<?php

namespace App\Imports;

use App\Models\Reports;
use Maatwebsite\Excel\Concerns\ToModel;

class ReportsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Reports([
            //
        ]);
    }
}
