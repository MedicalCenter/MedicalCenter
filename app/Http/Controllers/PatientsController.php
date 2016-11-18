<?php

namespace App\Http\Controllers;

Use DB;

class PatientsController extends Controller
{

    public function getPatients() {

        $patients = DB::table('patients')->get();
        return view('testing', ['data' => $patients]);
    }

    public function getPatientById($id) {
        $patients = DB::table('patients')->where('id', $id)->get();
        return view('testing', ['data' => $patients]);
    }

    public function getPatientByPesel($pesel) {
        $patients = DB::table('patients')->where('pesel', $pesel)->get();
        return view('testing', ['data' => $patients]);
    }

}