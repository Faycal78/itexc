<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\MedicalHistoryController;

// Public routes
Route::post('register/doctor', [DoctorController::class, 'register']);
Route::post('register/patient', [PatientController::class, 'register']);
Route::post('login/doctor', [DoctorController::class, 'login']);
Route::post('login/patient', [PatientController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Doctor routes
    Route::resource('doctors', DoctorController::class)->only(['index', 'show', 'update', 'destroy']);

    // Patient routes
    Route::resource('patients', PatientController::class)->only(['index', 'show', 'update', 'destroy']);

    // Appointment routes
    Route::resource('appointments', AppointmentController::class);

    // Prescription routes
    Route::resource('prescriptions', PrescriptionController::class);

    // MedicalHistory routes
    Route::resource('medical_histories', MedicalHistoryController::class);

    // Logout route
    Route::post('logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    });
});
