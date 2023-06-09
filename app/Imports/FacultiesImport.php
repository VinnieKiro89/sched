<?php

namespace App\Imports;

use App\Models\Faculty;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FacultiesImport implements ToModel, SkipsEmptyRows, WithHeadingRow, 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Faculty([
            'name'  => $row['Name of Faculty (Family Name, First Name & Middle Initial) In alphabetical order'],
            'undergraduate' => $row['Undergraduate'],
            'graduate' => $row['Graduate'],
            'professional_license' => $row['Professional License Number & Expiration Date'],
            'name_of_company' => $row['Name of Company/Position'],
            'length_of_teaching' => $row['Length of Teaching Experience in PUP'],
            'field' => $row['Field of Specialization'],
            'subj_taught' => $row['Subjects Taught'],
            'nature_of_appt' => $row['Nature of Appointment (permanent/temporary)'],
            'status' => $row['Status (fulltime/part-time)'],
            'contact' => $row['Contact Number'],
            'email' => $row['Email Address'],
        ]);
    }

    public function headingRow(): int
    {
        return 6;
    }
}
