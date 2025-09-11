<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Crear proyecto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required'
        ]);
        $project = Project::create($validated);
        return response()->json($project, 201);
    }

    // Leer todos los proyectos
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects, 200);
    }

    // Leer proyecto por ID
    public function show($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }
        return response()->json($project, 200);
    }

    // Actualizar proyecto
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required'
        ]);
        $project->update($validated);
        return response()->json($project, 200);
    }

    // Eliminar proyecto
    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }
        $project->delete();
        return response()->json(null, 204);
    }
}
