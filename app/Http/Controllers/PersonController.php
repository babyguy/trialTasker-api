<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $persons = Person::Orderby('id', 'desc')->paginate(10);
        $persons->load('per_type_person');
        return response()->json($persons, 200);
    }
    
    public function all(): JsonResponse
    {
        $persons = Person::Orderby('id', 'desc')->get();
        $persons->load('per_type_person');
        return response()->json($persons, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'per_name' => ['required', 'string'],
                'per_lastname' => ['string', 'nullable'],
                'per_email' => ['string', 'nullable'],
                'per_phone' => ['string', 'nullable'],
                'per_address' => ['string', 'nullable'],
                'per_nit' => ['string', 'nullable'],
                'per_issue_nit' => ['string', 'nullable'],
                'per_num_ministry' => ['string', 'nullable'],
                'per_num_dispaych' => ['string', 'nullable'],
                'per_radicated' => ['string', 'nullable'],
                'per_authority' => ['string', 'nullable'],
                'per_number' => ['string', 'nullable'],
                'per_type_person_id' => ['required', 'integer'],
            ]);

            $person = Person::create([
                'per_name' => $request->per_name,
                'per_lastname' => $request->per_lastname,
                'per_email' => $request->per_email,
                'per_phone' => $request->per_phone,
                'per_address' => $request->per_address,
                'per_nit' => $request->per_nit,
                'per_issue_nit' => $request->per_issue_nit,
                'per_num_ministry' => $request->per_num_ministry,
                'per_num_dispaych' => $request->per_num_dispaych,
                'per_radicated' => $request->per_radicated,
                'per_authority' => $request->per_authority,
                'per_number' => $request->per_number,
                'per_type_person_id' => $request->per_type_person_id,
            ]);
            return response()->json(['message' => 'Persona creada correctamente'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $person = Person::find($id);
        $person->load('per_type_person');
        return response()->json($person, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {

        try {
            $request->validate([
                'per_name' => ['required', 'string'],
                'per_lastname' => ['string', 'nullable'],
                'per_email' => ['string', 'nullable'],
                'per_phone' => ['string', 'nullable'],
                'per_address' => ['string', 'nullable'],
                'per_nit' => ['string', 'nullable'],
                'per_issue_nit' => ['string', 'nullable'],
                'per_num_ministry' => ['string', 'nullable'],
                'per_num_dispaych' => ['string', 'nullable'],
                'per_radicated' => ['string', 'nullable'],
                'per_authority' => ['string', 'nullable'],
                'per_number' => ['string', 'nullable'],
                'per_type_person_id' => ['required', 'integer'],
            ]);

            $person = Person::find($id);
            $person->per_name = $request->per_name;
            $person->per_lastname = $request->per_lastname;
            $person->per_email = $request->per_email;
            $person->per_phone = $request->per_phone;
            $person->per_address = $request->per_address;
            $person->per_nit = $request->per_nit;
            $person->per_issue_nit = $request->per_issue_nit;
            $person->per_num_ministry = $request->per_num_ministry;
            $person->per_num_dispaych = $request->per_num_dispaych;
            $person->per_radicated = $request->per_radicated;
            $person->per_authority = $request->per_authority;
            $person->per_number = $request->per_number;
            $person->per_type_person_id = $request->per_type_person_id;
            $person->save();
            return response()->json(['message' => 'Persona actualizada correctamente'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $person = Person::find($id);
        $person->delete();
        return response()->json(['message' => 'Persona eliminada correctamente'], 201);
    }
}
