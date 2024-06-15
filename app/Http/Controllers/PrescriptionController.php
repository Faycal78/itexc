<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::all();
        return response()->json($prescriptions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'medication' => 'required|string',
            'dosage' => 'required|string',
            'frequency' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $prescription = Prescription::create($validated);
        return response()->json($prescription, 201);
    }

    public function show($id)
    {
        $prescription = Prescription::findOrFail($id);
        return response()->json($prescription);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'patient_id' => 'exists:patients,id',
            'doctor_id' => 'exists:doctors,id',
            'medication' => 'string',
            'dosage' => 'string',
            'frequency' => 'string',
            'start_date' => 'date',
            'end_date' => 'date',
        ]);

        $prescription = Prescription::findOrFail($id);
        $prescription->update($validated);
        return response()->json($prescription);
    }

    public function destroy($id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->delete();
        return response()->json(null, 204);
    }
}
