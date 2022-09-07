<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLoad extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'day', 'start_date', 'end_date'];
}
