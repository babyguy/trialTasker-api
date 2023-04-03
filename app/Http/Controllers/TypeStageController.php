<?php

namespace App\Http\Controllers;

use App\Models\TypeStage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypeStageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        $typeStage = TypeStage::orderBy('id', 'desc')->paginate(10);
        return response()->json($typeStage);
    }

    public function all():JsonResponse
    {
        $typeStage = TypeStage::all();
        return response()->json($typeStage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse
    {
         try {
            $request->validate([
                'type_stage_name'=>['required','string','unique:type_stages']
            ]);

            $typeStage = TypeStage::create([
                'type_stage_name'=> $request->type_stage_name,
            ]);
            return response()->json(['message' => 'Tipo de etapa creada correctamente'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

 

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $typeStage = TypeStage::findOrFail($id);
        return response()->json($typeStage);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):JsonResponse
    {
        try {
            $typeStage = TypeStage::findOrFail($id);

            $request->validate([
                'type_stage_name'=>['required','string','unique:type_stages']
            ]);

            TypeStage::find($id)->update([
                'type_stage_name'=> $request->type_stage_name,
            ]);

            return response()->json(['message' => 'Tipo de etapa actualizada correctamente'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(["errors" => $e->errors()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        TypeStage::find($id)->delete();
        return response()->json(['message' => 'Tipo de etapa eliminada exitosamente'], 201);
    }
}
