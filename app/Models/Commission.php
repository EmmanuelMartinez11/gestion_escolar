<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = ['room', 'schedule', 'course_id', 'professor_id'];

    // Relación muchos a uno con Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relación muchos a uno con Professor
    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }


    public function courseStudents()
    {
        return $this->hasMany(CourseStudent::class);
    }

    // Relación muchos a muchos a través del pivote con Student
    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student')
                    ->withTimestamps();
    }
}
