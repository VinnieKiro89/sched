<?php

namespace App\Imports;

use App\Models\Faculty;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FifthSheetBackupImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $col){
            Faculty::create([
                'id' => $col['id'],
                'user_id' => $col['user_id'],
                'name' => $col['name'],
                'undergraduate' => $col['undergraduate'],
                'graduate' => $col['graduate'],
                'post_graduate' => $col['post_graduate'],
                'professional_license' => $col['professional_license'],
                'name_of_company' => $col['name_of_company'],
                'length_of_teaching' => $col['length_of_teaching'],
                'field' => $col['field'],
                'subj_taught' => $col['subj_taught'],
                'nature_of_appt' => $col['nature_of_appt'],
                'status' => $col['status'],
                'email' => $col['email'],
                'contact' => $col['contact'],
                'num_of_subj' => $col['num_of_subj'],
                'day_avail' => $col['day_avail'],
                'hour_avail_from' => $col['hour_avail_from'],
                'hour_avail_to' => $col['hour_avail_to'],
                'created_at' => $col['created_at'],
                'updated_at' => $col['updated_at'],
            ]);
        }
    }
}
