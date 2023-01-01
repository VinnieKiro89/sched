<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    public function courseload()
    {
        return $this->hasMany(CourseLoad::class);
    }

    public function subject()
    {
        return $this->hasMany(Subject::class);
    }
}
