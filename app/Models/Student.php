<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    // Relación muchos a muchos con Course
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student')
                    ->withPivot('commission_id') // Incluye commission_id del pivote
                    ->withTimestamps();
    }
    
    public function courseStudents()
    {
        return $this->hasMany(CourseStudent::class);
    }

    // Relación uno a muchos a través del pivote con Commission
    public function commissions()
    {
        return $this->hasManyThrough(Commission::class, CourseStudent::class, 'student_id', 'id', 'id', 'commission_id');
    }
}
