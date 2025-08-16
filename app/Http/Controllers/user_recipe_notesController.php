<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_recipe_notes;

class user_recipe_notesController extends Controller
{
    public function index()
    {
        $user_recipe_notes = user_recipe_notes::all();
        return view('user_recipe_notes.index', compact('user_recipe_notes'));
    }
    public function create()
    {
        return view('user_recipe_notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'note' => 'required|string|max:255',
        ]);

        user_recipe_notes::create([
            'user_id' => Auth::id(),
            'recipe_id' => $request->recipe_id,
            'note' => $request->note,
        ]);

        return redirect()->route('user_recipe_notes.index')
            ->with('success', 'Nota creada exitosamente.');
    }

    public function show(user_recipe_notes $user_recipe_note)
    {
        // Verificar si la nota pertenece al usuario
        if($user_recipe_note->user_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }
        return view('user_recipe_notes.show', compact('user_recipe_note'));
    }

    public function edit(user_recipe_notes $user_recipe_note)
    {
        // Verificar si la nota pertenece al usuario
        if($user_recipe_note->user_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }
        return view('user_recipe_notes.edit', compact('user_recipe_note'));
    }

    public function update(Request $request, user_recipe_notes $user_recipe_note)
    {
        // Verificar si la nota pertenece al usuario
        if($user_recipe_note->user_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        $request->validate([
            'note' => 'required|string|max:255',
        ]);

        $user_recipe_note->update([
            'note' => $request->note,
        ]);

        return redirect()->route('user_recipe_notes.index')
            ->with('success', 'Nota actualizada exitosamente.');
    }

    public function destroy(user_recipe_notes $user_recipe_note)
    {
        // Verificar si la nota pertenece al usuario
        if($user_recipe_note->user_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        $user_recipe_note->delete();
        return redirect()->route('user_recipe_notes.index')
            ->with('success', 'Nota eliminada exitosamente.');
    }

}
