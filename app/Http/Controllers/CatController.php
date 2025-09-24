<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatController extends Controller
{
    // GET /cats
    public function index(Request $request)
    {
        $limit = $request->query('limit', 10); // Default 10
        $gatos = DB::select('SELECT * FROM gatos LIMIT ?', [$limit]);
        return response()->json($gatos);
    }

    // POST /cats
    public function store(Request $request)
    {
        DB::insert('INSERT INTO gatos (nombre) VALUES (?)', [$request->nombre]);
        return response()->json(['message' => 'Gato creado']);
    }

    // GET /cats/{id}
    public function show($id)
    {
        $gatos = DB::select('SELECT * FROM gatos WHERE id = ?', [$id]);
        if (empty($gatos)) {
            return response()->json(['error' => 'Gato no encontrado'], 404);
        }
        return response()->json($gatos[0]);
    }

    // PUT /cats/{id}
    public function update(Request $request, $id)
    {
        $gatos = DB::select('SELECT * FROM gatos WHERE id = ?', [$id]);
        if (empty($gatos)) {
            return response()->json(['error' => 'Gato no encontrado'], 404);
        }
        DB::update('UPDATE gatos SET nombre = ? WHERE id = ?', [
            $request->nombre,
            $id
        ]);
        return response()->json(['message' => 'Gato actualizado']);
    }

    // DELETE /cats/{id}
    public function destroy($id)
    {
        $gatos = DB::select('SELECT * FROM gatos WHERE id = ?', [$id]);
        if (empty($gatos)) {
            return response()->json(['error' => 'Gato no encontrado'], 404);
        }
        DB::delete('DELETE FROM gatos WHERE id = ?', [$id]);
        return response()->json(['message' => 'Eliminado correctamente']);
    }
}