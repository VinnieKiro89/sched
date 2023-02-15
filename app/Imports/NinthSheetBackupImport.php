<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NinthSheetBackupImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $col){
            User::create([
               'id' => $col['id'], 
               'fname' => $col['fname'],
               'username' => $col['username'],
               'role' => $col['role'],
               'password' => $col['password'],
               'created_at' => $col['created_at'],
               'updated_at' => $col['updated_at'],
            ]);
        }
    }
}
