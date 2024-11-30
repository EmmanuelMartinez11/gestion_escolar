<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use PDF; // Librería para generar PDFs

class ProfessorController extends Controller
{
    public function index(Request $request)
    {
        $query = Professor::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $professors = $query->paginate(10);

        return view('professors.index', compact('professors'));
    }

    // Mostrar el formulario para crear un nuevo profesor
    public function create()
    {
        return view('professors.create');
    }

    // Guardar un nuevo profesor
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Professor::create([
            'name' => $request->name,
        ]);

        return redirect()->route('professors.index')->with('success', 'Profesor creado exitosamente.');
    }

    // Mostrar el formulario para editar un profesor
    public function edit(Professor $professor)
    {
        return view('professors.edit', compact('professor'));
    }

    // Actualizar un profesor
    public function update(Request $request, Professor $professor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $professor->update([
            'name' => $request->name,
        ]);

        return redirect()->route('professors.index')->with('success', 'Profesor actualizado exitosamente.');
    }

    // Eliminar un profesor
    public function destroy(Professor $professor)
    {
        $professor->delete();
        return redirect()->route('professors.index')->with('success', 'Profesor eliminado exitosamente.');
    }

    public function generateReport()
    {
        $professors = Professor::with('commissions.course.subject')->get();
    
        $pdf = Pdf::loadView('professors.report', compact('professors'));
    
        return $pdf->download('reporte_asistencia_profesores.pdf');
    }
}
