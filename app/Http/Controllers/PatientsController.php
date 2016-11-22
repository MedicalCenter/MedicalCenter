<?php

namespace App\Http\Controllers;

use App\Patient;
Use DB;

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

    public function postInsertPatient(Request $requset)
    {
        $data = $requset->all();

        $patient = new Patient();

        $patient->first_name = $data['firstName'];
        $patient->last_name = $data['lastName'];
        $patient->pesel = $data['pesel'];
        $patient->birth_date = $data['datepicker'];
        $patient->address = $data['address'];

        $patient->save();

        return view('pages/patients');
    }

}