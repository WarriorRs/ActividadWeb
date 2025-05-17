<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        return Estudiante::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'cedula' => 'required|string|max:10|unique:estudiantes',
            'correo' => 'required|email|unique:estudiantes',
            'paralelo_id' => 'required|exists:paralelos,id',
        ]);

        $estudiante = Estudiante::create($request->all());

        return response()->json([
            'mensaje' => 'Estudiante creado exitosamente',
            'estudiante' => $estudiante
        ], 201);
    }

    public function show($id)
    {
        return Estudiante::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::findOrFail($id);

        $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'cedula' => 'sometimes|required|string|max:10|unique:estudiantes,cedula,' . $id,
            'correo' => 'sometimes|required|email|unique:estudiantes,correo,' . $id,
            'paralelo_id' => 'sometimes|required|exists:paralelos,id',
        ]);

        $estudiante->update($request->all());

        return response()->json(['mensaje' => 'Estudiante actualizado con éxito']);
    }

    public function destroy($id)
    {
        Estudiante::destroy($id);

        return response()->json(['mensaje' => 'Estudiante eliminado']);
    }
}
