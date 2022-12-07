<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_patient_master;
use App\Models\tbl_schedule_appointment;
use App\Models\tbl_generate_bill;
Use \Carbon\Carbon;

class PatientController extends Controller
{
    private $id = 1;
    // protected $id;

    public function patientLogin(Request $req, $phoneNo, $password)
    {   
        $info = tbl_patient_master::select('patient_id','patient_phone_number', 'patient_password')
        ->where('patient_phone_number','=',$phoneNo)
        ->where('patient_password','=',$password)
        ->where('patient_status','=',1)->get();

        $this->id = tbl_patient_master::select('patient_id')
        ->where('patient_phone_number','=',$phoneNo)
        ->where('patient_password','=',$password)
        ->where('patient_status','=',1)->value('patient_id');
 
        if(!($info == "[]")){
            return response()->json(array(
                "status" => 1,
                "message"=> "Login Successfull...",
            ));
        }
        else{
            return response()->json(array(
                "status" => -1,
                "message"=> "Patient Login Failed!"
            ));
        }
    }

    public function addNewPatient(Request $req)
    {
        $validated = validator($req->all(),[
            'patientName' => 'required | max:50',
            'patientPhoneNumber' => 'required | numeric | digits:10',
            'patientDOB' => 'required | date_format:Y-m-d',
            'patientMaritalStatus' => 'required | max:20',
            'patientBloodGroup' => 'required | max:5',
            'patientOccupation' => 'required | max:50',
            'patientGender' => 'required | max:10',
            'patientHeight' => 'required | max:10',
            'patientWeight' => 'required | max:10',
            'patientEmail' => 'nullable | email | max:255',
            'patientAddress' => 'required | max:255',
            'patientPassword' => 'required | max:255',
            'guardianName' => 'required | max:50',
            'guardianRelation' => 'required | max:20',
            'guardianPhoneNumber' => 'required | numeric | digits:10',
        ]);

        if($validated->fails()){
            $res = array(
                "status" => -1,
                "message" => "The given data is either empty or invalid.",
                "errors" => $validated->errors()
            );

            return response()->json($res);
        }

        $patientName = $req->input("patientName");
        $patientPhoneNumber = $req->input("patientPhoneNumber");
        $patientDOB = $req->input("patientDOB");
        $patientMaritalStatus = $req->input("patientMaritalStatus");
        $patientBloodGroup = $req->input("patientBloodGroup");
        $patientOccupation = $req->input("patientOccupation");
        $patientGender = $req->input("patientGender");
        $patientHeight = $req->input("patientHeight");
        $patientWeight = $req->input("patientWeight");
        $patientEmail = $req->input("patientEmail");
        $patientAddress = $req->input("patientAddress");
        $patientPassword = $req->input("patientPassword");
        $guardianName = $req->input("guardianName");
        $guardianRelation = $req->input("guardianRelation");
        $guardianPhoneNumber = $req->input("guardianPhoneNumber");
        
        $isSamePatient = tbl_patient_master::where('patient_phone_number', '=', $patientPhoneNumber)
        ->where("patient_password",'=',$patientPassword)
        ->where("patient_status", '=', '1')
        ->first();

        if(is_null($isSamePatient)){
            $newPatient = new tbl_patient_master();
            $newPatient->patient_name = $req->input("patientName");
            $newPatient->patient_phone_number = $req->input("patientPhoneNumber");
            $newPatient->patient_dob = $req->input("patientDOB");
            $newPatient->patient_marital_status = $req->input("patientMaritalStatus");
            $newPatient->patient_blood_group = $req->input("patientBloodGroup");
            $newPatient->patient_occupation = $req->input("patientOccupation");
            $newPatient->patient_gender =  $req->input("patientGender");
            $newPatient->patient_height =  $req->input("patientHeight");
            $newPatient->patient_weight =  $req->input("patientWeight");
            $newPatient->patient_email =   $req->input("patientEmail");
            $newPatient->patient_address = $req->input("patientAddress");
            $newPatient->patient_password =  $req->input("patientPassword");
            $newPatient->guardian_name =  $req->input("guardianName");
            $newPatient->guardian_relation = $req->input("guardianRelation");
            $newPatient->guardian_phone_number = $req->input("guardianPhoneNumber");
            
            if($newPatient->save()){
                return response()->json(array(
                    "status" => 1,
                    "message" => "New Patient Added Successfully..."
                ));
            }
            else{
                return response()->json(array(
                    "status" => -1,
                    "message" => "Something Went Wrong! Please Try Again..."
                ));
            }
        }
        else{
            return response()->json(array(
                "status" => 0,
                "message" => "Patient Already Exists!!!"
            ));
        }
    }

    public function getPatient()
    {
        $info = tbl_patient_master::select('patient_id','patient_name','patient_phone_number', 'patient_password',
         'patient_dob','patient_marital_status','patient_blood_group', 'patient_occupation', 'patient_gender', 'patient_height','patient_weight',
         'patient_email','patient_address','guardian_name','guardian_relation','guardian_phone_number','patient_status')
        ->where('patient_id','=',$this->id)
        ->where('patient_status','=',1)->first();

        return response()->json(
            $info);
    }

    public function editPatient(Request $req, $editPatientId)
    {
        $validated = validator($req->all(),[
            'editPatientName' => 'required | max:50',
            'editPatientPhoneNumber' => 'required | numeric | digits:10',
            'editPatientDOB' => 'required | date_format:Y-m-d',
            'editPatientMaritalStatus' => 'required | max:20',
            'editPatientBloodGroup' => 'required | max:5',
            'editPatientOccupation' => 'required | max:50',
            'editPatientGender' => 'required | max:10',
            'editPatientHeight' => 'required | max:10',
            'editPatientWeight' => 'required | max:10',
            'editPatientEmail' => 'nullable | email | max:255',
            'editPatientAddress' => 'required | max:255',
            'editPatientPassword' => 'required | max:255',
            'editGuardianName' => 'required | max:50',
            'editGuardianRelation' => 'required | max:20',
            'editGuardianPhoneNumber' => 'required | numeric | digits:10',
        ]);

        if($validated->fails()){
            $res = array(
                "status" => -1,
                "message" => "The given data is either empty or invalid.",
                "errors" => $validated->errors()
            );

            return response()->json($res);
        }

        $editPatientName = $req->input("editPatientName");
        $editPatientPhoneNumber = $req->input("editPatientPhoneNumber");
        $editPatientDOB = $req->input("editPatientDOB");
        $editPatientMaritalStatus = $req->input("editPatientMaritalStatus");
        $editPatientBloodGroup = $req->input("editPatientBloodGroup");
        $editPatientOccupation = $req->input("editPatientOccupation");
        $editPatientGender = $req->input("editPatientGender");
        $editPatientHeight = $req->input("editPatientHeight");
        $editPatientWeight = $req->input("editPatientWeight");
        $editPatientEmail = $req->input("editPatientEmail");
        $editPatientAddress = $req->input("editPatientAddress");
        $editPatientPassword = $req->input("editPatientPassword");
        $editGuardianName = $req->input("editGuardianName");
        $editGuardianRelation = $req->input("editGuardianRelation");
        $editGuardianPhoneNumber = $req->input("editGuardianPhoneNumber");

        if(tbl_patient_master::where('patient_id',"=",$editPatientId)->where('patient_name','=',$editPatientName)->where('patient_phone_number','=',$editPatientPhoneNumber)->where('patient_dob','=',$editPatientDOB)
        ->where('patient_marital_status','=',$editPatientMaritalStatus)->where('patient_blood_group','=',$editPatientBloodGroup)->where('patient_address','=',$editPatientAddress)->where('patient_password','=',$editPatientPassword)
        ->where('guardian_name','=',$editGuardianName)->where('guardian_relation','=',$editGuardianRelation)
        ->where('patient_gender','=',$editPatientGender)->where('patient_height','=',$editPatientHeight)->where('patient_weight','=',$editPatientWeight)->where('patient_email','=',$editPatientEmail)
        ->where('patient_occupation','=',$editPatientOccupation)->where('guardian_phone_number','=',$editGuardianPhoneNumber)->exists())
        {
            $res = array(
                "status" => -1,
                "message" => "Nothing is updated!",
                "errors" => null
            );
            return response()->json($res);
        }
        else 
        {
            if(tbl_patient_master::where('patient_id',"!=",$editPatientId)->where('patient_phone_number', '=', $editPatientPhoneNumber)->where('patient_password', '=', $editPatientPassword)->exists()){
                $res = array(
                    "status" => -1,
                    "message" => "Account with same Phone Number and Password Already Exists!",
                    "errors" => null
                );
                return response()->json($res);
            }
            else
            {
                tbl_patient_master::where('patient_id', '=', $editPatientId)
                ->update(['patient_name'=>$editPatientName,
                 'patient_phone_number'=>$editPatientPhoneNumber,
                 'patient_dob'=>$editPatientDOB,
                 'patient_marital_status'=>$editPatientMaritalStatus,
                 'patient_blood_group'=>$editPatientBloodGroup,
                 'patient_gender'=>$editPatientGender,
                 'patient_height'=>$editPatientHeight,
                 'patient_weight'=>$editPatientWeight,
                 'patient_email'=>$editPatientEmail,
                 'patient_address'=>$editPatientAddress,
                 'patient_password'=>$editPatientPassword,
                 'guardian_name'=>$editGuardianName,
                 'guardian_relation'=>$editGuardianRelation,
                 'guardian_phone_number'=>$editGuardianPhoneNumber,
                 'patient_occupation'=>$editPatientOccupation
                ]);
                $res = array(
                    "status" => 1,
                    "message" => "Patient Details Updated Successfully.",
                    "errors" => null
                );
                return response()->json($res);
            }
        }
    }

    public function patientAppointment(Request $req)
    {
        $validated = validator($req->all(),[
            'patientId' => 'required | numeric',
            'currentDate'=> 'required | date_format:Y-m-d',
            'patientAge'=> 'required | numeric',
            'appointmentDate'=> 'required | date_format:Y-m-d',
            'appointmentTime'=> 'required',
            'medicalDepartment'=> 'required | max:50 ',
            'symptoms'=> 'required | max:20 ',
            'note'=> 'nullable  | max:255',
            
        ]);

        if($validated->fails()){
            $res = array(
                "status" => -1,
                "message" => "The given data is either empty or invalid.",
                "errors" => $validated->errors()
            );

            return response()->json($res);
        }

        $patientId = $req->input("patientId");
        $currentDate =$req->input("currentDate");
        $patientAge =$req->input("patientAge");
        $appointmentDate =$req->input("appointmentDate");
        $appointmentTime =$req->input("appointmentTime");
        $medicalDepartment = $req->input("medicalDepartment");
        $symptoms =$req->input("symptoms");
        $note = $req->input("note");

        $isSameAppointment = tbl_schedule_appointment::where('patient_id', '=', $patientId)
        ->where("appointment_date",'=',$appointmentDate)
        ->where("appointment_time",'=',$appointmentTime)
        ->where("appointment_status", '=', '1')
        ->first();

        if(is_null($isSameAppointment)){
            $newAppointment = new tbl_schedule_appointment();
            $newAppointment->patient_id = $req->input("patientId");
            $newAppointment->patient_age = $req->input("patientAge");
            $newAppointment->current_date = $req->input("currentDate");
            $newAppointment->appointment_date =$req->input("appointmentDate");
            $newAppointment->appointment_time =$req->input("appointmentTime");
            $newAppointment->medical_dept = $req->input("medicalDepartment");
            $newAppointment->symptoms = $req->input("symptoms");
            $newAppointment->note = $req->input("note");
            
            if($newAppointment->save()){
                return response()->json(array(
                    "status" => 1,
                    "message" => "Appointment Scheduled Successfully..."
                ));
            }
            else{
                return response()->json(array(
                    "status" => -1,
                    "message" => "Something Went Wrong! Please Try Again..."
                ));
            }
        }
        else{
            return response()->json(array(
                "status" => 0,
                "message" => "Appointment Already Scheduled!!!"
            ));
        }
    }

    public function getAllAppointments(Request $request){
        $paginate = request("paginate", 10);
        $search_term = request("search", "");
        $search_term = trim($search_term);
        $search_term = "%$search_term%";
        $sort_field = request("sortfield");
        $sort_direction = request("sortdirection");

        if(!in_array($sort_direction, ['asc', 'desc'])){
            $sort_direction = "asc";
        }

        if(!in_array($sort_field, ['appointment_id', 'medical_dept', 'appointment_date','appointment_time'])){
            $sort_field = "appointment_date";
        }

        $date = Carbon::now()->format('Y-m-d');

        return (tbl_schedule_appointment::select('appointment_id', 'appointment_time', 'medical_dept', 'symptoms','appointment_date', 'patient_id', 'current_date', 'patient_age', 'note', 'appointment_status')
        ->where('appointment_status', '=', 1)
        ->whereDate('appointment_date','>=', $date)
        ->where('patient_id', '=', $this->id)
        ->where(function($query) use ($search_term){
            $query->where('medical_dept', 'like', $search_term)
                ->orWhere('appointment_date', 'like', $search_term)
                ->orWhere('appointment_time', 'like', $search_term)
                ->orWhere('symptoms', 'like', $search_term)
                ->orWhere('appointment_id', 'like', $search_term);
        })
        ->orderBy($sort_field, $sort_direction)
        ->paginate($paginate));
    }

    public function editAppointment(Request $req, $editAppointmentId)
    {
        $validated = validator($req->all(),[
            'editPatientId' => 'required | numeric',
            'editCurrentDate'=> 'required | date_format:Y-m-d',
            'editPatientAge'=> 'required | numeric',
            'editAppointmentDate'=> 'required | date_format:Y-m-d',
            'editAppointmentTime'=> 'required',
            'editMedicalDepartment'=> 'required | max:50 ',
            'editSymptoms'=> 'required | max:20 ',
            'editNote'=> 'nullable  | max:255',
        ]);

        if($validated->fails()){
            $res = array(
                "status" => -1,
                "message" => "The given data is either empty or invalid.",
                "errors" => $validated->errors()
            );

            return response()->json($res);
        }

        $editPatientId = $req->input("editPatientId");
        $editCurrentDate =$req->input("editCurrentDate");
        $editPatientAge =$req->input("editPatientAge");
        $editAppointmentDate =$req->input("editAppointmentDate");
        $editAppointmentTime =$req->input("editAppointmentTime");
        $editMedicalDepartment = $req->input("editMedicalDepartment");
        $editSymptoms =$req->input("editSymptoms");
        $editNote = $req->input("editNote");

        $date = Carbon::now()->format('Y-m-d');
        
        if(tbl_schedule_appointment::where('appointment_id', '=', $editAppointmentId)
        ->where('patient_id','=',$editPatientId)->where('note','=',$editNote)->where('symptoms','=',$editSymptoms)
        ->where('medical_dept','=',$editMedicalDepartment)->where('appointment_time','=',$editAppointmentTime)
        ->where('current_date','=',$editCurrentDate)->where('patient_age','=',$editPatientAge)->where('appointment_date','=',$editAppointmentDate)
        ->exists())
        {
            $res = array(
                "status" => -1,
                "message" => "Nothing is updated!",
                "errors" => null
            );
            return response()->json($res);
        }
        else
        {
            if($editAppointmentDate >= $date)
            {
                tbl_schedule_appointment::where('appointment_id', '=', $editAppointmentId)
                ->update(['patient_id'=>$editPatientId,
                'patient_age'=>$editPatientAge,
                'current_date'=>$editCurrentDate,
                'appointment_date'=>$editAppointmentDate,
                'appointment_time'=>$editAppointmentTime,
                'medical_dept'=>$editMedicalDepartment,
                'symptoms'=>$editSymptoms,       
                'note'=>$editNote
                ]);
                $res = array(
                    "status" => 1,
                    "message" => "Appointment Details Updated Successfully.",
                    "errors" => null
                );
                return response()->json($res);
            }
            else
            {
                $res = array(
                    "status" => -1,
                    "message" => "Appointment Date cannot be less than Current Date!",
                    "errors" => $validated->errors()
                );
            
                return response()->json($res);
            }
        }
    }

    public function deleteAppointment(Request $request, $appointmentId){
        tbl_schedule_appointment::where('appointment_id', '=', $appointmentId)->update(["appointment_status"=>0]);
        $res = array(
            "status" => 1,
            "message" => "Appointment Deleted Successfully.",
            "errors" => null
        );
        return response()->json($res);
    }

    public function getPatientDetails(Request $request, $patientId)
    {
        $date = Carbon::now()->format('Y-m-d');

        $info = tbl_patient_master::join('tbl_schedule_appointments','tbl_schedule_appointments.patient_id','tbl_patient_masters.patient_id')
        ->where('patient_status', '=', 1)
        ->where('appointment_status', '=', 1)
        ->whereDate('appointment_date','>=', $date)
        ->where('tbl_patient_masters.patient_id', '=', $patientId)
        ->select('tbl_patient_masters.patient_id','patient_name','patient_phone_number', 'patient_password',
        'patient_dob','patient_marital_status','patient_blood_group', 'patient_occupation', 'patient_gender', 'patient_height','patient_weight',
        'patient_email','patient_address','guardian_name','guardian_relation','guardian_phone_number','patient_status',
        'appointment_id','current_date','patient_age','appointment_date','appointment_time','medical_dept','symptoms','note','appointment_status')
        ->get();

        return response()->json(
            $info);
    }

    public function getBillDate(Request $request, $appointmentDate, $appointmentTime)
    {
        $info = tbl_schedule_appointment::select('appointment_id','current_date','patient_age','appointment_date','appointment_time','medical_dept','symptoms','note','appointment_status')
        ->where('appointment_date','=',$appointmentDate)
        ->where('appointment_time','=',$appointmentTime)
        ->where('appointment_status','=',1)
        ->first();

        return response()->json(
            $info);
    }

    public function getAllBills(Request $req)
    {
        $paginate = request("paginate", 10);
        $search_term = request("search", "");
        $search_term = trim($search_term);
        $search_term = "%$search_term%";
        $sort_field = request("sortfield");
        $sort_direction = request("sortdirection");

        if(!in_array($sort_direction, ['asc', 'desc'])){
            $sort_direction = "desc";
        }

        if(!in_array($sort_field, ['bill_id', 'medical_dept', 'appointment_date','appointment_time'])){
            $sort_field = "appointment_date";
        }

        return (tbl_generate_bill::join('tbl_patient_masters','tbl_patient_masters.patient_id','tbl_generate_bills.patient_id')
        ->join('tbl_schedule_appointments','tbl_schedule_appointments.appointment_id','tbl_generate_bills.appointment_id')
        ->where('bill_status', '=', 1)
        ->where('tbl_patient_masters.patient_id', '=', $this->id)
        ->where(function($query) use ($search_term){
            $query->where('medical_dept', 'like', $search_term)
                ->orWhere('appointment_date', 'like', $search_term)
                ->orWhere('appointment_time', 'like', $search_term)
                ->orWhere('symptoms', 'like', $search_term)
                ->orWhere('bill_id', 'like', $search_term);
        })
        ->select('bill_id', 'appointment_time', 'medical_dept', 'symptoms','appointment_date','tbl_patient_masters.patient_id','tbl_schedule_appointments.appointment_id')
        ->orderBy($sort_field, $sort_direction)
        ->paginate($paginate));
    }
}
