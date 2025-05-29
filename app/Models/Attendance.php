<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'status',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
