<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;
use PDF; // Librería para generar PDFs

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::all();
        $query = Course::with('subject');

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $courses = $query->paginate(10);

        return view('courses.index', compact('courses', 'subjects'));
    }

    // Mostrar el formulario para crear un curso
    public function create()
    {
        $subjects = Subject::all();

        return view('courses.create', compact('subjects'));
    }

    // Guardar un nuevo curso
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Course::create([
            'name' => $request->name,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->route('courses.index')->with('success', 'Curso creado exitosamente.');
    }

    // Mostrar el formulario para editar un curso
    public function edit(Course $course)
    {
        $subjects = Subject::all();

        return view('courses.edit', compact('course', 'subjects'));
    }

    // Actualizar un curso
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $course->update([
            'name' => $request->name,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->route('courses.index')->with('success', 'Curso actualizado exitosamente.');
    }

    // Eliminar un curso
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Curso eliminado exitosamente.');
    }

    public function generateReport()
    {
        $courses = Course::with('subject')->get()->groupBy('subject.name');

        $pdf = Pdf::loadView('courses.report', compact('courses'));

        return $pdf->download('reporte_cursos.pdf');
    }
}
