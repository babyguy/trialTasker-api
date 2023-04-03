<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        $file = File::orderBy('id', 'desc')->paginate(10);
        $file->load('file_stage');
        return response()->json($file, 200);
    }
    public function all():JsonResponse
    {
        $file = File::orderBy('id', 'desc')->get();
        $file->load('file_stage');
        return response()->json($file, 200);
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
    public function store(Request $request)
    {
        try {
            $request->validate([
                'file_name'=>['required', 'string'],
                'file_url'=>['required', 'string'],
                'file_stage_id'=>['required', 'integer'],
            ]);

            $file = File::create([
                'file_name'=>$request->file_name,
                'file_url'=>$request->file_url,
                'file_stage_id'=>$request->file_stage_id,
            ]);
            return response()->json(['message' => 'Archivo almacenado correctamente'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file = File::findOrFail($id);
        $file->load('file_stage');
        return response()->json($file);
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
    public function update(Request $request, string $id)
    {
        try {
            $file = File::findOrFail($id);

            $request->validate([
                'file_name'=>['required', 'string'],
                'file_url'=>['required', 'string'],
                'file_stage_id'=>['required', 'integer'],
            ]);

            File::find($id)->update([
                'file_name'=>$request->file_name,
                'file_url'=>$request->file_url,
                'file_stage_id'=>$request->file_stage_id,
            ]);

            return response()->json(['message' => 'archivo actualizado correctamente'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(["errors" => $e->errors()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         File::find($id)->delete();
        return response()->json(['message' => 'Archivo eliminado exitosamente'], 201);
    }
}
