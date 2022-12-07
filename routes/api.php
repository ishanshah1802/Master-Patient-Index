<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Patient
Route::get('/patientlogin/{patient_phone_number}/{patient_password}', [PatientController::class,'patientLogin']);
Route::post("/addpatient", [PatientController::class, "addNewPatient"]);
Route::get("/getpatient", [PatientController::class, "getPatient"]);
Route::put("/editpatient/{patient_id}", [PatientController::class, "editPatient"]);
Route::post("/scheduleappointment", [PatientController::class, "patientAppointment"]);
Route::get("/patientmanageappointment", [PatientController::class, "getAllAppointments"]);
Route::put("/editappointment/{appointment_id}", [PatientController::class, "editAppointment"]);
Route::delete("/deleteappointment/{appointment_id}", [PatientController::class, "deleteAppointment"]);
Route::get("/getpatientdetails/{patient_id}", [PatientController::class, "getPatientDetails"]);
Route::get("/getpatientbills", [PatientController::class, "getAllBills"]);
Route::get("/getappointmentdetails/{appointment_date}/{appointment_time}", [PatientController::class, "getBillDate"]);

// Staff
Route::get('/stafflogin/{staff_phone_number}/{staff_password}', [StaffController::class,'staffLogin']);
Route::get("/staffsidegetpatient/{patient_id}", [StaffController::class, "getPatient"]);
Route::put("/editstaff/{staff_id}", [StaffController::class, "editStaff"]);
Route::get("/getstaff", [StaffController::class, "getStaff"]);
Route::get("/selectedpatientdata/{patient_id}", [StaffController::class, "getDetails"]);
Route::get("/staffmanageappointment", [StaffController::class, "getAllAppointments"]);
Route::get("/getbills", [StaffController::class, "getAllBills"]);

// PDF
Route::post("/addbill", [PDFController::class, "addBill"]);
