<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use PDF;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();
        $query = Student::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('course_id')) {
            $query->whereHas('courses', function ($query) use ($request) {
                $query->where('course_id', $request->course_id);
            });
        }

        $students = $query->paginate(10);

        return view('students.index', compact('students', 'courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('students.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        foreach ($request->course_ids as $courseId) {
            $student->courses()->attach($courseId, [
                'commission_id' => null, // Cambia esto si necesitas un valor específico
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Estudiante creado exitosamente.');
    }

    public function edit(Student $student)
    {
        $courses = Course::all();
        return view('students.edit', compact('student', 'courses'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $student->courses()->sync(
            collect($request->course_ids)->mapWithKeys(fn($courseId) => [$courseId => ['commission_id' => null]])->toArray()
        );

        return redirect()->route('students.index')->with('success', 'Estudiante actualizado exitosamente.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Estudiante eliminado exitosamente.');
    }

    public function generateReport()
    {
        $students = Student::with('courses.commissions')->get();

        $pdf = PDF::loadView('students.report', compact('students'));

        return $pdf->download('reporte_estudiantes_inscritos.pdf');
    }
}
