<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Pending_Visits;
use App\Visit;
Use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class VisitsController
{
    public function registerVisit($patientId)
    {
        $user = Auth::user();

        if ($user->role == '2') {
            $patient = DB::table('patients')->where('id', $patientId)->first();
            $doctors = DB::table('doctors')->get();

            return view('pages/registerVisit', compact('patient', 'doctors'));
        } else {
            return redirect('/mainPage');
        }
    }


    public function postRegisterVisit($patientId, Request $request)
    {

        $user = Auth::user();

        if ($user->role == '2') {
            $patient = DB::table('patients')->where('id', $patientId)->first();
            $doctors = DB::table('doctors')->get();
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'doctor' => 'required',
                'type' => 'required',
                'datepicker' => 'required',
                'timepicker' => 'required',
            ],
                [
                    'doctor.required' => 'Wybranie lekarza jest wymagane',
                    'type.required' => 'Wpisanie typu wizyty jest wymagane',
                    'datepicker.required' => 'Podanie daty wizyty jest wymagane',
                    'timepicker.required' => 'Podanie czasu wizyty jest wymagane'
                ]
            );
            if ($validator->fails()) {
                return view('pages/registerVisit', compact('patient', 'doctors'))
                    ->withErrors($validator);
            }
            $visit = new Pending_visits();
            $visit->date_of_visit = $data['datepicker'];
            $visit->hour_of_visit = $data['timepicker'];
            $visit->doctor_id = $data['doctor'];
            $visit->patient_id = $patientId;
            $visit->type_visit = $data['type'];
            $visit->save();
            return view('pages/registerVisit', compact('patient', 'doctors'))->with(["message" => "Dodano wizytę!"]);
        } else {
            return redirect('/mainPage');
        }


    }

    public function pendingVisits($patientId)
    {
        $user = Auth::user();

        if ($user->role == '2') {
            $doctors = DB::table('doctors')->get();
            $patient = DB::table('patients')->where('id', $patientId)->first();
            $visits = DB::table('pending_visits')->where('patient_Id', $patientId)
                ->join('doctors', 'pending_visits.doctor_id', '=', 'doctors.id')
                ->select('pending_visits.*', 'doctors.first_name', 'doctors.last_name')->get();
            return view('pages/pendingVisits', compact('visits', 'patient', 'doctors'));
        } else {
            return redirect('/mainPage');
        }
    }

    public function removePendingVisit($visitId)
    {
        $user = Auth::user();

        if ($user->role == '2') {
            $visit = Pending_visits::find($visitId);
            $patient = Patient::find($visit->patient_id);
            $visit->delete();
            $doctors = DB::table('doctors')->get();
            $visits = DB::table('pending_visits')->where('patient_Id', $patient->id)
                ->join('doctors', 'pending_visits.doctor_id', '=', 'doctors.id')
                ->select('pending_visits.*', 'doctors.first_name', 'doctors.last_name')->get();
            return view('pages/pendingVisits', compact('visits', 'patient', 'doctors'));
        } else {
            return redirect('/mainPage');
        }


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
        $doctors = DB::table('doctors')->get();
        $patient = DB::table('patients')->where('id', $patientId)->first();
        $visits = DB::table('pending_visits')->where('patient_Id', $patientId)
            ->join('doctors', 'pending_visits.doctor_id', '=', 'doctors.id')
            ->select('pending_visits.*', 'doctors.first_name', 'doctors.last_name')->get();
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'doctor' => 'required',
            'type' => 'required',
            'datepicker' => 'required',
            'timepicker' => 'required',
        ],
            [
                'doctor.required' => 'Wybranie lekarza jest wymagane',
                'type.required' => 'Wpisanie typu wizyty jest wymagane',
                'datepicker.required' => 'Podanie daty wizyty jest wymagane',
                'timepicker.required' => 'Podanie czasu wizyty jest wymagane'
            ]
        );
        if ($validator->fails()) {
            return view('pages/pendingVisits', compact('visits', 'patient', 'doctors'))
                ->withErrors($validator);
        }
        DB::table('pending_visits')->where('id', $data['visitId'])->update(['date_of_visit' => $data['datepicker'],
            'doctor_id' => $data['doctor'], 'type_visit' => $data['type'], 'hour_of_visit' => $data['timepicker']]);
        return view('pages/pendingVisits', compact('visits', 'patient', 'doctors'))->with(["message" => "Wizyta edytowana!"]);
    }


    public function listDoctorVisitsForToday()
    {
        $user = Auth::user();

        if ($user->role == '3') {
            $doctorId = $user->doctorId;
            $date = date('m/d/Y', time());
            $visits = DB::table('pending_visits')->where('doctor_id', $doctorId)->where('date_of_visit', $date)
                ->join('patients', 'pending_visits.patient_id', '=', 'patients.id')
                ->select('pending_visits.*', 'patients.first_name', 'patients.last_name')->get();

//            dd($visits);

            return view('pages/doctorsVisits', ['data' => $visits]);
        } else {
            return redirect('/mainPage');
        }
    }

    public function listPatientVisitsHistory($patientId)
    {

        $user = Auth::user();

        if ($user->role == '3') {
            $history = DB::table('visits')->where('patient_id', $patientId)
                ->join('doctors', 'visits.doctor_id', '=', 'doctors.id')
                ->select('visits.*', 'doctors.first_name', 'doctors.last_name')->orderBy('id', 'desc')->get();
            return view('pages/patientPastVisits', ['data' => $history]);
        } else {
            return redirect('/mainPage');
        }
    }

    public function listVisitDetails($visitId) {
        $user = Auth::user();

        if ($user->role == '3') {
            $history = DB::table('visits')->where('id', $visitId)->first();
            return view('pages/visitDetails', ['data' => $history]);
        } else {
            return redirect('/mainPage');
        }
    }
    
    public function endVisit(Request $request, $id){

        $data = $request->all();
        
        $pendingVisit = Pending_Visits::find($id);

        $pendingVisit->delete();

        $visit = new Visit();
        $visit->date_of_visit = $data['date'];
        $visit->hour_of_visit = $data['hour'];
        $visit->price = $data['price'];
        $visit->diagnosis = $data['diagnosis'];
        $visit->type = $data['type'];
        $visit->doctor_id= $data['doctor_id'];
        $visit->patient_id = $data['patient_id'];

        $visit->save();



        return redirect('/doctors/visits');




    }


}