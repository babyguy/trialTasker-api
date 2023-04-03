<?php

namespace App\Http\Controllers;

use App\Models\PersonStage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PersonStageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $personStage = PersonStage::orderBy('id', 'desc')->paginate(10);
        $personStage->load('person_stage_stage', 'person_stage_person');
        return response()->json($personStage, 200);
    }

    public function all(): JsonResponse
    {
        $personStage = PersonStage::all();
        $personStage->load('person_stage_stage', 'person_stage_person');
        return response()->json($personStage, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'person_stage_person_id' => ['required', 'integer'],
                'person_stage_stage_id' => ['required', 'integer'],
            ]);

            $personStage = PersonStage::create([
                'person_stage_person_id' => $request->person_stage_person_id,
                'person_stage_stage_id' => $request->person_stage_stage_id,
            ]);
            return response()->json(['message' => 'Persona agregada al estado correctamente'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $personStage = PersonStage::find($id);
        $personStage->load('person_stage_stage', 'person_stage_person');
        return response()->json($personStage);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $personStage = PersonStage::findOrFail($id);

            $request->validate([
                'person_stage_person_id' => ['required', 'integer'],
                'person_stage_stage_id' => ['required', 'integer'],
            ]);

            PersonStage::find($id)->update([
                'person_stage_person_id' => $request->person_stage_person_id,
                'person_stage_stage_id' => $request->person_stage_stage_id,
            ]);

            return response()->json(['message' => 'actualizado correctamente'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(["errors" => $e->errors()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        PersonStage::find($id)->delete();
        return response()->json(['message' => 'eliminado exitosamente'], 201);
    }
}
