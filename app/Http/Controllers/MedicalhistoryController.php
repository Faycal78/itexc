<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalHistory;

class MedicalHistoryController extends Controller
{
    public function index()
    {
        $medicalHistories = MedicalHistory::all();
        return response()->json($medicalHistories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'required|string',
        ]);

        $medicalHistory = MedicalHistory::create($validated);
        return response()->json($medicalHistory, 201);
    }

    public function show($id)
    {
        $medicalHistory = MedicalHistory::findOrFail($id);
        return response()->json($medicalHistory);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'patient_id' => 'exists:patients,id',
            'doctor_id' => 'exists:doctors,id',
            'diagnosis' => 'string',
            'treatment' => 'string',
            'notes' => 'string',
        ]);

        $medicalHistory = MedicalHistory::findOrFail($id);
        $medicalHistory->update($validated);
        return response()->json($medicalHistory);
    }

    public function destroy($id)
    {
        $medicalHistory = MedicalHistory::findOrFail($id);
        $medicalHistory->delete();
        return response()->json(null, 204);
    }
}
