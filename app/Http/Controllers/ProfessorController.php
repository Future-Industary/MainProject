<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    
    public function index()
    {
        return response()->json(Professor::all());
    }

    public function show($id)
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor not found'], 404);
        }

        return response()->json($professor);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'email' => 'required|email|unique:professors,email',
        ]);

        $professor = Professor::create($validated);

        return response()->json($professor, 201);
    }

    
    public function update(Request $request, $id)
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'department' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:professors,email,' . $id,
        ]);

        $professor->update($validated);

        return response()->json($professor);
    }

    
    public function destroy($id)
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor not found'], 404);
        }

        $professor->delete();

        return response()->json(['message' => 'Professor deleted']);
    }
    
}