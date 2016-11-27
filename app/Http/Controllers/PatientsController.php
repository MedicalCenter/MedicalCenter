<?php

namespace App\Http\Controllers;

use App\Patient;
use Auth;
use DB;
use Illuminate\Http\Request;

class PatientsController extends Controller
{

    public function getPatients()
    {

        $user = Auth::user();

        if ($user->role == '2') {
            $patients = DB::table('patients')->get();
            return view('pages/patients', ['data' => $patients]);
        } else {
            return redirect('/mainPage');
        }
    }

    public function insertPatient()
    {
        $user = Auth::user();

        if ($user->role == '2') {
            return view('pages/patientInsert');
        } else {
            return redirect('/mainPage');
        }
    }

    public function postInsertPatient(Request $request)
    {
        $user = Auth::user();

        if ($user->role == '2') {
            $data = $request->all();

            //dd($data);/// ZOBACZ SOBIE TO JAK NAPRAWISZ
            $patient = new Patient();

            $patient->first_name = $data['firstName'];
            $patient->last_name = $data['lastName'];
            $patient->pesel = $data['pesel'];
            $patient->date_of_birth = $data['datepicker'];
            $patient->address = $data['address'];

            $patient->save();


            $patients = DB::table('patients')->get();
            return view('pages/patients', ['data' => $patients]);
        } else {
            return redirect('/mainPage');
        }
    }

    public function unregisterPatient()
    {

        $user = Auth::user();

        if ($user->role == '2') {
            return view('pages/removeVisit', ['data' => []]);
        } else {
            return redirect('/mainPage');
        }
    }

    public function postUnregisterPatient(Request $request)
    {

        $user = Auth::user();

        if ($user->role == '2') {
            $data = $request->all();

            $lastName = $data['lastName'];
            $patient = DB::table('patients')->where('last_name', $lastName)->get();
            $pendingVisits = DB::table('pending_visits')->where('patient_id', $patient->id);

            return view('pages/removeVisit', ['data' => $pendingVisits]);
        } else {
            return redirect('/mainPage');
        }
    }

}