<?php

namespace App\Http\Controllers;

use App\Models\TypePerson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypePersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $typePersons = TypePerson::orderBy('id', 'desc')->paginate(10);
        return response()->json($typePersons);
    }

    /**
     * Display a listing of the resource.
     */

    public function all(): JsonResponse
    {
        $typePersons = TypePerson::all();
        return response()->json($typePersons);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'type_person_name' => 'required|string|max:255',
        ];
        try {
            $this->validate($request, $rules);
            $typePerson = TypePerson::create($request->all());
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json(["errors" => $e->errors()], 422);
        }
        return response()->json($typePerson);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $typePerson = TypePerson::findOrFail($id);
        return response()->json($typePerson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $rules = [
            'type_person_name' => 'required|string|max:255',
        ];
        try {
            $this->validate($request, $rules);
            $typePerson = TypePerson::findOrFail($id);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json($e->errors(), 422);
        }
        $typePerson->update($request->all());
        return response()->json($typePerson);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $typePerson = TypePerson::findOrFail($id);
        $typePerson->delete();
        return response()->json($typePerson);
    }
}
