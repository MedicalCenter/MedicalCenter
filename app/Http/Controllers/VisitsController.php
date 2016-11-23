<?php

namespace App\Http\Controllers;

use App\Patient;
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

    public function pendingVisits($patientId)
    {
        $doctors = DB::table('doctors')->get();
        $patient = DB::table('patients')->where('id', $patientId)->first();
        $visits = DB::table('pending_visits')->where('patient_Id', $patientId)
            ->join('doctors', 'pending_visits.doctor_id', '=', 'doctors.id')
            ->select('pending_visits.*', 'doctors.first_name', 'doctors.last_name')->get();
        return view('pages/pendingVisits', compact('visits', 'patient', 'doctors'));

    }

    public function removePendingVisit($visitId)
    {


        $visit = Pending_visits::find($visitId);
        $patient = Patient::find($visit->patient_id);
        $visit->delete();
        $doctors = DB::table('doctors')->get();
        $visits = DB::table('pending_visits')->where('patient_Id', $patient->id)
            ->join('doctors', 'pending_visits.doctor_id', '=', 'doctors.id')
            ->select('pending_visits.*', 'doctors.first_name', 'doctors.last_name')->get();
        return view('pages/pendingVisits', compact('visits', 'patient', 'doctors'));

    }


    public function ajaxDate(Request $request)
    {

        $data = $request->all();

        $query = DB::table('pending_visits')->select('hour_of_visit')
            ->where('doctor_id', $data['doctor'])->where('date_of_visit', 'like', $data['freeDate'])->get();

        return json_encode($query);
    }


    public function editVisit(Request $request, $patientId)
    {
        $data = $request->all();
        DB::table('pending_visits')->where('id', $data['visitId'])->update(['date_of_visit'=>$data['datepicker'],
            'doctor_id'=>$data['doctor'], 'type_visit'=>$data['type'], 'hour_of_visit'=>$data['timepicker']]);

        $doctors = DB::table('doctors')->get();
        $patient = DB::table('patients')->where('id', $patientId)->first();
        $visits = DB::table('pending_visits')->where('patient_Id', $patientId)
            ->join('doctors', 'pending_visits.doctor_id', '=', 'doctors.id')
            ->select('pending_visits.*', 'doctors.first_name', 'doctors.last_name')->get();

        return view('pages/pendingVisits', compact('visits', 'patient', 'doctors'));
    }


}