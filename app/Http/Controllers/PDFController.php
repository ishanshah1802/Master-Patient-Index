<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\tbl_generate_bill;
use App\Models\tbl_patient_master;
use App\Models\tbl_schedule_appointment;
 
use PDF;
   
class PDFController extends Controller
{
    public function addBill(Request $req)
    {
        $validated = validator($req->all(),[
            'patientId'=> 'required',
            'appointmentId'=>'required',
            'consultingFees' => 'required | numeric',
            
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
        $appointmentId = $req->input("appointmentId");
        $consultingFees = $req->input("consultingFees");
       
        
        $isSameBill = tbl_generate_bill::where('appointment_id', '=', $appointmentId)
        ->where("patient_id",'=',$patientId)
        ->where("bill_status", '=', '1')
        ->first();

        if(is_null($isSameBill)){
            $newBill = new tbl_generate_bill();
            $newBill->patient_id = $req->input("patientId");
            $newBill->appointment_id = $req->input("appointmentId");
            $newBill->consulting_fees = $req->input("consultingFees");
         
            
            if($newBill->save()){
                return response()->json(array(
                    "status" => 1,
                    "message" => "New Bill Added Successfully..."
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
                "message" => "Bill Already Exists!!!"
            ));
        }
    }

    public function generateBillPDF(Request $req, $patientId, $appointmentId)
    {
        $data = tbl_generate_bill::join('tbl_patient_masters','tbl_patient_masters.patient_id','tbl_generate_bills.patient_id')
        ->join('tbl_schedule_appointments','tbl_schedule_appointments.appointment_id','tbl_generate_bills.appointment_id')
        ->where('tbl_generate_bills.patient_id','=',$patientId)
        ->where('tbl_generate_bills.appointment_id','=',$appointmentId)
        ->where('bill_status','=',1)
        ->where('patient_status','=',1)
        ->where('appointment_status','=',1)
        ->select('tbl_generate_bills.appointment_id','tbl_patient_masters.patient_id','bill_id','patient_name','consulting_fees','patient_phone_number','patient_dob','patient_gender','patient_age','patient_height','patient_weight','current_date','appointment_date','appointment_time','medical_dept','symptoms')
        ->first();

        $billId = tbl_generate_bill::join('tbl_patient_masters','tbl_patient_masters.patient_id','tbl_generate_bills.patient_id')
        ->join('tbl_schedule_appointments','tbl_schedule_appointments.appointment_id','tbl_generate_bills.appointment_id')
        ->where('tbl_generate_bills.patient_id','=',$patientId)
        ->where('tbl_generate_bills.appointment_id','=',$appointmentId)
        ->where('bill_status','=',1)
        ->select('bill_id')
        ->first();

        $amount = tbl_generate_bill::join('tbl_patient_masters','tbl_patient_masters.patient_id','tbl_generate_bills.patient_id')
        ->join('tbl_schedule_appointments','tbl_schedule_appointments.appointment_id','tbl_generate_bills.appointment_id')
        ->where('tbl_generate_bills.patient_id','=',$patientId)
        ->where('tbl_generate_bills.appointment_id','=',$appointmentId)
        ->where('bill_status','=',1)
        ->value('consulting_fees');

        $amountInWords = (new PDFController)->getAmountInWords($amount);
     
        $pdf = PDF::loadView('GenerateBillPDF', array("data" => $data, "amountInWords" => $amountInWords));

        return $pdf->stream('Bill - ' . $billId . '.pdf');
    }

    function getAmountInWords(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' And ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . "Only";
    }
}