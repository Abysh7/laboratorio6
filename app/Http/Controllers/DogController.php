<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dog;

class DogController extends Controller
{
    // GET /dogs
    public function index(Request $request)
    {
        $limit = $request->query('limit', 10); // Default 10
        $dogs = Dog::limit($limit)->get();
        return response()->json($dogs);
    }

    // POST /dogs
    public function store(Request $request)
    {
        $dog = Dog::create($request->all());
        return response()->json(['message' => 'Perro creado', 'dog' => $dog]);
    }

    // GET /dogs/{id}
    public function show($id)
    {
        $dog = Dog::find($id);
        if (!$dog) {
            return response()->json(['error' => 'Perro no encontrado'], 404);
        }
        return response()->json($dog);
    }

    // PUT /dogs/{id}
    public function update(Request $request, $id)
    {
        $dog = Dog::find($id);
        if (!$dog) {
            return response()->json(['error' => 'Perro no encontrado'], 404);
        }
        $dog->update($request->all());
        return response()->json(['message' => 'Perro actualizado']);
    }

    // DELETE /dogs/{id}
    public function destroy($id)
    {
        $dog = Dog::find($id);
        if (!$dog) {
            return response()->json(['error' => 'Perro no encontrado'], 404);
        }
        $dog->delete();
        return response()->json(['message' => 'Perro eliminado']);
    }
}