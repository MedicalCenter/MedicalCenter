<?php

namespace App\Http\Controllers;

use App\Pending_Visits;
use App\Visit;
Use DB;
use Illuminate\Http\Request;

class VisitsController
{

    public function getPendingVisits()
    {
        $pending = DB::table('pending_visits')->get();
        return view('testing', ['data' => $pending]);
    }

    public function getPendingVisitsOnDay($data)
    {
        $pending = DB::table('pending_visits')->where('date_of_visit', $data)->get();
        return view('testing', ['data' => $pending]);
    }

    public function getPendingVisitsOnDayForDoctor($date, $doctorId)
    {
        $pending = DB::table('pending_visits')->where([
            ['doctor_id', $doctorId],
            ['date_of_visit', $date]
        ])->get();

        return view('testing', ['data' => $pending]);
    }

    public function getPendingVisitsForPatient($patientId)
    {
        $pending = DB::table('pending_visits')->where('patient_id', $patientId)->get();
        return view('testing', ['data' => $pending]);
    }

    public function getPatientHistory($patientId)
    {
        $history = DB::table('visits')->where('patient_id', $patientId)->get();
        return view('testing', ['data' => $history]);
    }


    public function registerVisit($patientId)
    {

        $patient = DB::table('patients')->where('id', $patientId)->first();
        $doctors = DB::table('doctors')->get();

        return view('pages/registerVisit', compact('patient', 'doctors'));
    }


    public function postRegisterVisit($patientId, Request $requset)
    {

        $patient = DB::table('patients')->where('id', $patientId)->first();
        $doctors = DB::table('doctors')->get();

        $data = $requset->all();

        $visit = new Pending_visits();

        $visit->date_of_visit = $data['datepicker'];
        $visit->hour_of_visit = $data['timepicker'];
        $visit->doctor_id = $data['doctor'];
        $visit->patient_id = $patientId;
        $visit->type_visit = $data['type'];

        $visit->save();
        return view('pages/registerVisit', compact('patient', 'doctors'));
    }


    public function ajaxDate(Request $request){

        $data = $request->all();

        $query = DB::table('pending_visits')->select('hour_of_visit')
            ->where('doctor_id', $data['doctor'])->where('date_of_visit','like', $data['freeDate'])->get();

        return json_encode($query);
    }


}