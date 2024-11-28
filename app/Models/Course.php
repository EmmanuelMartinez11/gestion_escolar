<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'subject_id'];

    // Relación muchos a uno con Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Relación muchos a muchos con Student
    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student')
                    ->withPivot('commission_id')
                    ->withTimestamps();
    }

    public function courseStudents()
    {
        return $this->hasMany(CourseStudent::class);
    }

    // Relación uno a muchos con Commission
    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }
}
