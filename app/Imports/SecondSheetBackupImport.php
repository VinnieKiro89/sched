<?php

namespace App\Imports;

use App\Models\Course;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SecondSheetBackupImport implements ToCollection,  WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $col){

                Course::create([
                    'id' => $col['id'],
                    'course_code' => $col['course_code'],
                    'description' => $col['description'],
                    'created_at' => $col['created_at'],
                    'updated_at' => $col['updated_at']
                ]);
            
        }
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'string'],
            'course_code' => ['required', 'string'],
            'description' => ['required', 'string'],
            'created_at' => ['required', 'string'],
            'updated_at' => ['required', 'string']
        ];
    }
}
