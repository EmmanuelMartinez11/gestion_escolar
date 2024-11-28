<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Mostrar listado de materias
    public function index(Request $request)
    {
        $subjects = Subject::when($request->name, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->name . '%');
        })->paginate(10);

        return view('subjects.index', compact('subjects'));
    }

    // Mostrar formulario para crear una materia
    public function create()
    {
        return view('subjects.create');
    }

    // Almacenar nueva materia
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')->with('success', 'Materia creada correctamente.');
    }

    // Mostrar formulario para editar una materia
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    // Actualizar materia
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('success', 'Materia actualizada correctamente.');
    }

    // Eliminar materia
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Materia eliminada correctamente.');
    }
}
