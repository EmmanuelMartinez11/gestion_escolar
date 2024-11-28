<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Course;
use App\Models\Professor;
use Illuminate\Http\Request;
use PDF; // Librería para generar PDFs

class CommissionController extends Controller
{
    // Mostrar el listado de comisiones
    public function index(Request $request)
    {
        $courses = Course::all();
        $query = Commission::with(['course', 'professor']);

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('horario')) {
            $query->where('horario', 'like', '%' . $request->horario . '%');
        }

        $commissions = $query->paginate(10);

        return view('commissions.index', compact('commissions', 'courses'));
    }

    // Mostrar el formulario para crear una comisión
    public function create()
    {
        $courses = Course::all();
        $professors = Professor::all();

        return view('commissions.create', compact('courses', 'professors'));
    }

    // Guardar una nueva comisión
    public function store(Request $request)
    {
        $request->validate([
            'aula' => 'required|string',
            'horario' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'professor_id' => 'nullable|exists:professors,id',
        ]);

        Commission::create([
            'aula' => $request->aula,
            'horario' => $request->horario,
            'course_id' => $request->course_id,
            'professor_id' => $request->professor_id,
        ]);

        return redirect()->route('commissions.index')->with('success', 'Comisión creada exitosamente.');
    }

    // Mostrar el formulario para editar una comisión
    public function edit(Commission $commission)
    {
        $courses = Course::all();
        $professors = Professor::all();

        return view('commissions.edit', compact('commission', 'courses', 'professors'));
    }

    // Actualizar una comisión
    public function update(Request $request, Commission $commission)
    {
        $request->validate([
            'aula' => 'required|string',
            'horario' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'professor_id' => 'nullable|exists:professors,id',
        ]);

        $commission->update([
            'aula' => $request->aula,
            'horario' => $request->horario,
            'course_id' => $request->course_id,
            'professor_id' => $request->professor_id,
        ]);

        return redirect()->route('commissions.index')->with('success', 'Comisión actualizada exitosamente.');
    }

    // Eliminar una comisión
    public function destroy(Commission $commission)
    {
        $commission->delete();
        return redirect()->route('commissions.index')->with('success', 'Comisión eliminada exitosamente.');
    }



    public function generateReport()
    {
        $commissions = Commission::with('course.subject', 'professor')->get();

        $pdf = Pdf::loadView('commissions.report', compact('commissions'));

        return $pdf->download('reporte_comisiones.pdf');
    }

}
