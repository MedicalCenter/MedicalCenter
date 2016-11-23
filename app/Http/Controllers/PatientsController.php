<?php

namespace App\Http\Controllers;

use App\Patient;
Use DB;
use Illuminate\Http\Request;

class PatientsController extends Controller
{

    public function getPatients() {

        $patients = DB::table('patients')->get();
        return view('pages/patients', ['data' => $patients]);
    }

    public function getPatientById($id) {
        $patients = DB::table('patients')->where('id', $id)->get();
        return view('testing', ['data' => $patients]);
    }

    public function getPatientByPesel($pesel) {
        $patients = DB::table('patients')->where('pesel', $pesel)->get();
        return view('testing', ['data' => $patients]);
    }

    public function insertPatient() {
        return view('pages/patientInsert');
    }

    public function postInsertPatient(Request $request)
    {
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
    }

    public function unregisterPatient() {
        return view('pages/removeVisit', ['data' => []]);
    }

    public function postUnregisterPatient(Request $request) {
        $data = $request->all();

        $lastName = $data['lastName'];
        $patient = DB::table('patients')->where('last_name', $lastName)->get();
        $pendingVisits = DB::table('pending_visits')->where('patient_id', $patient->id);

        return view('pages/removeVisit', ['data' => $pendingVisits]);
    }

}