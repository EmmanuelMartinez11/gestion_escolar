<?php

namespace App\Http\Controllers;

use App\Models\CourseStudent;
use App\Models\Student;
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
        $courses = Course::all();
        $commissions = Commission::all();
        return view('course_students.create', compact('students', 'courses', 'commissions'));
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
        $students = Student::all();
        $courses = Course::all();
        $commissions = Commission::all();
        return view('course_students.edit', compact('courseStudent', 'students', 'courses', 'commissions'));
    }

    public function update(Request $request, CourseStudent $courseStudent)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'commission_id' => 'required|exists:commissions,id',
        ]);

        $exists = CourseStudent::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->where('id', '<>', $courseStudent->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['El estudiante ya está inscrito en otra comisión de este curso.']);
        }

        $courseStudent->update($request->all());
        return redirect()->route('course_students.index')->with('success', 'Inscripción actualizada exitosamente.');
    }

    public function destroy(CourseStudent $courseStudent)
    {
        $courseStudent->delete();
        return redirect()->route('course_students.index')->with('success', 'Inscripción eliminada exitosamente.');
    }
}
