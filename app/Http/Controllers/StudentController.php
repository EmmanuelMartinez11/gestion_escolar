<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use PDF; // Librería para generar PDFs

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

    // Mostrar el formulario para crear un estudiante
    public function create()
    {
        $courses = Course::all();
        return view('students.create', compact('courses'));
    }

    // Guardar un nuevo estudiante
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        ]);

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('students.index')->with('success', 'Estudiante creado exitosamente.');
    }


    // Mostrar el formulario para editar un estudiante
    public function edit(Student $student)
    {
        $courses = Course::all();
        return view('students.edit', compact('student', 'courses'));
    }

    // app/Http/Controllers/StudentController.php
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);
    
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    
        return redirect()->route('students.index')->with('success', 'Estudiante actualizado exitosamente.');
    }
    
    

    // Eliminar un estudiante
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Estudiante eliminado exitosamente.');
    }

    public function generateReport()
    {
        $students = Student::with(['courses.commissions'])->get();

        $pdf = PDF::loadView('students.report', compact('students'));

        return $pdf->download('reporte_estudiantes_inscritos.pdf');
    }

}
