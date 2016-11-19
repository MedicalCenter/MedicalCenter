<?php

namespace App\Http\Controllers;

Use DB;
use Illuminate\Http\Request;

class VisitsController
{
    public function getPendingVisits() {
        $pending = DB::table('pending_visits')->get();
        return view('testing', ['data' => $pending]);
    }

    public function getPendingVisitsOnDay($data) {
        $pending = DB::table('pending_visits')->where('date_of_visit', $data)->get();
        return view('testing', ['data' => $pending]);
    }

    public function getPendingVisitsOnDayForDoctor($date, $doctorId) {
        $pending =  DB::table('pending_visits')->where([
            ['doctor_id', $doctorId],
            ['date_of_visit', $date]
        ])->get();

        return view('testing', ['data' => $pending]);
    }

    public function getPendingVisitsForPatient($patientId) {
        $pending = DB::table('pending_visits')->where('patient_id', $patientId)->get();
        return view('testing', ['data' => $pending]);
    }

    public function getPatientHistory($patientId) {
        $history = DB::table('visits')->where('patient_id', $patientId)->get();
        return view('testing', ['data' => $history]);
    }


    public function registerVisit($patientId){

        $patient = DB::table('patients')->where('id', $patientId)->first();
        $doctors = DB::table('doctors')->get();

        return view('pages/registerVisit', compact('patient','doctors'));
    }


    public function postRegisterVisit($patientId, Request $requset){

        $data = $requset->all();



        
        dd($data);



        return view('pages/registerVisit');
    }


}