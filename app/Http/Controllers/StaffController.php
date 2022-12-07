<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_staff_master;
use App\Models\tbl_patient_master;
use App\Models\tbl_schedule_appointment;
use App\Models\tbl_generate_bill;
Use \Carbon\Carbon;

class StaffController extends Controller
{
    private $id = 1;
    
    public function staffLogin(Request $req, $staffPhone, $staffPass)
    {   
        $info = tbl_staff_master::select('staff_id','staff_phone_number', 'staff_password')
        ->where('staff_phone_number','=',$staffPhone)
        ->where('staff_password','=',$staffPass)
        ->where('staff_status','=',1)->get();

        $this->id = tbl_staff_master::select('staff_id')
        ->where('staff_phone_number','=',$staffPhone)
        ->where('staff_password','=',$staffPass)
        ->where('staff_status','=',1)->value('staff_id');
 
        if(!($info == "[]")){
            return response()->json(array(
                "status" => 1,
                "message"=> "Staff Login Successfull...",
            ));
        }
        else{
            return response()->json(array(
                "status" => -1,
                "message"=> "Staff Login Failed!"
            ));
        }
    }

    public function getStaff()
    {
        $info = tbl_staff_master::select('staff_id','staff_name','staff_phone_number', 'staff_password',
         'staff_dob','staff_marital_status','staff_blood_group', 'staff_designation', 'staff_department' ,'staff_gender',
         'staff_email','staff_address','staff_status')
        ->where('staff_id','=',$this->id)
        ->where('staff_status','=',1)->first();

        return response()->json(
            $info);
    }

    public function editStaff(Request $req, $editStaffId)
    {
        $validated = validator($req->all(),[
            'editStaffName' => 'required | max:50',
            'editStaffPhoneNumber' => 'required | numeric | digits:10',
            'editStaffDOB' => 'required | date_format:Y-m-d',
            'editStaffMaritalStatus' => 'required | max:20',
            'editStaffBloodGroup' => 'required | max:5',
            'editStaffDesignation' => 'required | max:50',
            'editStaffDept' => 'required | max:50',
            'editStaffGender' => 'required | max:10',
            'editStaffEmail' => 'nullable | email | max:255',
            'editStaffAddress' => 'required | max:255',
            'editStaffPassword' => 'required | max:255'
        ]);

        if($validated->fails()){
            $res = array(
                "status" => -1,
                "message" => "The given data is either empty or invalid.",
                "errors" => $validated->errors()
            );

            return response()->json($res);
        }

        $editStaffName = $req->input("editStaffName");
        $editStaffPhoneNumber = $req->input("editStaffPhoneNumber");
        $editStaffDOB = $req->input("editStaffDOB");
        $editStaffMaritalStatus = $req->input("editStaffMaritalStatus");
        $editStaffBloodGroup = $req->input("editStaffBloodGroup");
        $editStaffDesignation = $req->input("editStaffDesignation");
        $editStaffDept = $req->input("editStaffDept");
        $editStaffGender = $req->input("editStaffGender");
        $editStaffEmail = $req->input("editStaffEmail");
        $editStaffAddress = $req->input("editStaffAddress");
        $editStaffPassword = $req->input("editStaffPassword");

        if(tbl_staff_master::where('staff_id',"=",$editStaffId)->where('staff_blood_group','=',$editStaffBloodGroup)
        ->where('staff_designation','=',$editStaffDesignation)
        ->where('staff_name','=',$editStaffName)->where('staff_phone_number','=',$editStaffPhoneNumber)
        ->where('staff_dob','=',$editStaffDOB)->where('staff_marital_status','=',$editStaffMaritalStatus)
        ->where('staff_password','=',$editStaffPassword)->where('staff_address','=',$editStaffAddress)
        ->where('staff_email','=',$editStaffEmail)->where('staff_gender','=',$editStaffGender)
        ->where('staff_department','=',$editStaffDept)->exists())
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
            if(tbl_staff_master::where('staff_id',"!=",$editStaffId)->where('staff_phone_number', '=', $editStaffPhoneNumber)->where('staff_password', '=', $editStaffPassword)->exists()){
                $res = array(
                    "status" => -1,
                    "message" => "Account with same Phone Number and Password Already Exists!",
                    "errors" => null
                );
                return response()->json($res);
            }
            else
            {
                tbl_staff_master::where('staff_id', '=', $editStaffId)
                ->update(['staff_name'=>$editStaffName,
                 'staff_phone_number'=>$editStaffPhoneNumber,
                 'staff_dob'=>$editStaffDOB,
                 'staff_marital_status'=>$editStaffMaritalStatus,
                 'staff_blood_group'=>$editStaffBloodGroup,
                 'staff_gender'=>$editStaffGender,
                 'staff_email'=>$editStaffEmail,
                 'staff_address'=>$editStaffAddress,
                 'staff_password'=>$editStaffPassword,
                 'staff_designation'=>$editStaffDesignation,
                 'staff_department'=>$editStaffDept
                ]);
                $res = array(
                    "status" => 1,
                    "message" => "Staff Details Updated Successfully.",
                    "errors" => null
                );
                return response()->json($res);
            }
        }
    }

    public function getDetails(Request $req, $patientId)
    {
        return (tbl_patient_master::select("patient_name", "patient_dob")->where("patient_id", "=", $patientId)->where("patient_status", true)->first());
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

        if(!in_array($sort_field, ['patient_id', 'patient_name' ,'appointment_id', 'medical_dept', 'appointment_date','appointment_time'])){
            $sort_field = "appointment_date_time";
        }

        $date = Carbon::now()->format('Y-m-d');

        return (tbl_schedule_appointment::join('tbl_patient_masters', 'tbl_schedule_appointments.patient_id', "=", 'tbl_patient_masters.patient_id')
        ->select('tbl_schedule_appointments.appointment_id', 'tbl_schedule_appointments.appointment_time', 'tbl_patient_masters.patient_name' ,'tbl_patient_masters.patient_phone_number' ,'tbl_schedule_appointments.medical_dept', 'tbl_schedule_appointments.symptoms','tbl_schedule_appointments.appointment_date', 'tbl_patient_masters.patient_id', 'tbl_schedule_appointments.current_date', 'tbl_schedule_appointments.note', 'tbl_schedule_appointments.appointment_status')
        ->where('tbl_schedule_appointments.appointment_status', '=', 1)
        ->whereDate('appointment_date','>=', $date)
        ->where(function($query) use ($search_term){
            $query->where('tbl_schedule_appointments.medical_dept', 'like', $search_term)
                ->orWhere('tbl_patient_masters.patient_id', 'like', $search_term)
                ->orWhere('tbl_patient_masters.patient_name', 'like', $search_term)
                ->orWhere('tbl_patient_masters.patient_phone_number', 'like', $search_term)
                ->orWhere('tbl_schedule_appointments.appointment_date', 'like', $search_term)
                ->orWhere('tbl_schedule_appointments.appointment_time', 'like', $search_term)
                ->orWhere('tbl_schedule_appointments.symptoms', 'like', $search_term)
                ->orWhere('tbl_schedule_appointments.appointment_id', 'like', $search_term);
        })
        ->orderBy($sort_field, $sort_direction)
        ->paginate($paginate));
    }

    public function getPatient(Request $req, $patientId)
    {
        $info = tbl_patient_master::select('patient_id','patient_name','patient_phone_number', 'patient_password',
         'patient_dob','patient_marital_status','patient_blood_group', 'patient_occupation', 'patient_gender', 'patient_height','patient_weight',
         'patient_email','patient_address','guardian_name','guardian_relation','guardian_phone_number','patient_status')
        ->where('patient_id','=',$patientId)
        ->where('patient_status','=',1)->first();

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

        if(!in_array($sort_field, ['bill_id', 'medical_dept', 'appointment_date','appointment_time', 'patient_id', 'patient_name'])){
            $sort_field = "appointment_date";
        }

        return (tbl_generate_bill::join('tbl_patient_masters','tbl_patient_masters.patient_id','tbl_generate_bills.patient_id')
        ->join('tbl_schedule_appointments','tbl_schedule_appointments.appointment_id','tbl_generate_bills.appointment_id')
        ->where('bill_status', '=', 1)
        ->where(function($query) use ($search_term){
            $query->where('medical_dept', 'like', $search_term)
                ->orWhere('appointment_date', 'like', $search_term)
                ->orWhere('appointment_time', 'like', $search_term)
                ->orWhere('symptoms', 'like', $search_term)
                ->orWhere('bill_id', 'like', $search_term)
                ->orWhere('tbl_patient_masters.patient_id', 'like', $search_term)
                ->orWhere('patient_name', 'like', $search_term);
        })
        ->select('bill_id', 'appointment_time', 'medical_dept', 'symptoms','appointment_date','tbl_patient_masters.patient_id','tbl_schedule_appointments.appointment_id','patient_name')
        ->orderBy($sort_field, $sort_direction)
        ->paginate($paginate));
    }
}
