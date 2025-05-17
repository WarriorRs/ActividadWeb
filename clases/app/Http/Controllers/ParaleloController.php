<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Paralelo;
use Illuminate\Http\Request;

class ParaleloController extends Controller
{
    // Método para obtener todos los paralelos
    public function index()
    {
        return Paralelo::all();
    }

    // Método para crear un nuevo paralelo
    public function store(Request $request)
    {
        Log::info('Datos que llegan en la peticion', $request->all());
        $request->validate([
            'nombre' => 'required|string|max:100|unique:paralelo'
        ]);
        $paralelo = Paralelo::create($request->all());
        Log::info('Paralelo creado con ID: '. $paralelo->id);
        return response()->json([
            'mensaje' => 'Paralelo creado exitosamente',
            'paralelo' => $paralelo
        ], 201);
    }

    public function show($id)
    {
        Log::info('INICIANDO UNA SOLICITUD DE CONSULTA CON ID: ');
        $paralelo = Paralelo::find($id);
        
        if (!$paralelo){
            return response()->json(['mensaje' => 'Paralelo no encontrado'], 404);
        }
        Log::info('Datos ENCONTRADOS ');
        return $paralelo;
        
    }

    // Método para actualizar un paralelo existente
    public function update(Request $request, $id)
    {
        $paralelo = Paralelo::find($id);
        if (!$paralelo){
            return response()->json(['mensaje' => 'Paralelo no encontrado'], 404);
        }
        $request->validate([
    'nombre' => 'required|string|max:100|unique:paralelos,nombre'
]);

        return $paralelo;
    }

    // Método para eliminar un paralelo
    public function destroy($id)
    {
        Paralelo::destroy($id);
        return response()->json(['message' => 'Paralelo eliminado']);
    }
}
