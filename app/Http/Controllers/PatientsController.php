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
        $patients = DB::table('patients')->get();
        return view('testing', ['data' => $patients]);
    }

}