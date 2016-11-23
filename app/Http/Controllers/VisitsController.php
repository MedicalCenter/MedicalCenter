<?php

namespace App\Http\Controllers;

use App\Pending_Visits;
use App\Visit;
Use DB;
use Illuminate\Http\Request;

class VisitsController
{
   public function registerVisit($patientId)
    {

        $patient = DB::table('patients')->where('id', $patientId)->first();
        $doctors = DB::table('doctors')->get();

        return view('pages/registerVisit', compact('patient', 'doctors'));
    }


    public function postRegisterVisit($patientId, Request $request)
    {

        $patient = DB::table('patients')->where('id', $patientId)->first();
        $doctors = DB::table('doctors')->get();

        $data = $request->all();

        $visit = new Pending_visits();
    
        $visit->date_of_visit = $data['datepicker'];
        $visit->hour_of_visit = $data['timepicker'];
        $visit->doctor_id = $data['doctor'];
        $visit->patient_id = $patientId;
        $visit->type_visit = $data['type'];

        $visit->save();
        return view('pages/registerVisit', compact('patient', 'doctors'));
    }

    public function pendingVisits($patientId) {

        $patient = DB::table('patients')->where('id', $patientId)->first();
        $visits = DB::table('pending_visits')->where('patient_Id', $patientId)
            ->join('doctors', 'pending_visits.doctor_id', '=', 'doctors.id')
            ->select('pending_visits.*', 'doctors.first_name', 'doctors.last_name')->get();
        return view('pages/pendingVisits', compact('visits', 'patient'));

    }


    public function ajaxDate(Request $request){

        $data = $request->all();

        $query = DB::table('pending_visits')->select('hour_of_visit')
            ->where('doctor_id', $data['doctor'])->where('date_of_visit','like', $data['freeDate'])->get();

        return json_encode($query);
    }


}