<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    use HasFactory;

    protected $table = 'course_student';

    protected $fillable = ['student_id', 'course_id', 'commission_id'];

    /**
     * Relación con el modelo Student.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Relación con el modelo Course.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relación con el modelo Commission.
     */
    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }
}
