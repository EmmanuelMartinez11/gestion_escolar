<?php

namespace App\Http\Controllers;

use App\Models\CourseStudent;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Course;

use App\Models\Commission;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    public function index()
    {
        $enrollments = CourseStudent::with(['student', 'course', 'commission'])->paginate(10);
        return view('course_students.index', compact('enrollments'));
    }
    

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all(); // Obtener todas las materias
        return view('course_students.create', compact('students', 'subjects'));
    }
    public function getCoursesBySubject($subjectId)
{
    $courses = Course::where('subject_id', $subjectId)->get();
    return response()->json(['courses' => $courses]);
}

public function getCommissionsByCourse($courseId)
{
    $commissions = Commission::where('course_id', $courseId)->get();
    return response()->json(['commissions' => $commissions]);
}


    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'commission_id' => 'required|exists:commissions,id',
        ]);

        // Verificar que el estudiante no esté inscrito en otra comisión del mismo curso
        $exists = CourseStudent::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['El estudiante ya está inscrito en una comisión de este curso.']);
        }

        CourseStudent::create($request->all());
        return redirect()->route('course_students.index')->with('success', 'Inscripción creada exitosamente.');
    }

    public function edit(CourseStudent $courseStudent)
    {
        // Obtener el estudiante asociado
        $student = $courseStudent->student;
    
        // Obtener la materia asociada al curso
        $subject = $courseStudent->course->subject;
    
        // Obtener las comisiones disponibles para el curso
        $commissions = $courseStudent->course->commissions;
    
        return view('course_students.edit', compact('courseStudent', 'student', 'subject', 'commissions'));
    }
    

    public function update(Request $request, CourseStudent $courseStudent)
    {
        $request->validate([
            'commission_id' => 'required|exists:commissions,id',
        ]);
    
        $courseStudent->update([
            'commission_id' => $request->commission_id,
        ]);
    
        return redirect()->route('course_students.index')->with('success', 'Comisión actualizada exitosamente.');
    }
    

    public function destroy(CourseStudent $courseStudent)
    {
        $courseStudent->delete();
        return redirect()->route('course_students.index')->with('success', 'Inscripción eliminada exitosamente.');
    }
}
