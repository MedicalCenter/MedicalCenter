<?php

namespace App\Http\Controllers;

use App\Patient;
Use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $patients = DB::table('patients')->get();
        $data = $request->all();

//        dd($data);
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|min:3|max:30',
            'lastName' => 'required|min:3|max:30',
            'pesel' => 'required|min:11|max:11',
            'datepicker' => 'required',
            'address' => 'required|max:30'
        ],
            [
                'firstName.required' => 'Imię jest wymagane',
                'firstName.min' => 'Imię wymaga minimalnie 3 liter',
                'firstName.max' => 'Imię maksymalnie 30 liter',
                'lastName.required' => 'Nazwisko jest wymagane',
                'lastName.min' => 'Nazwisko wymaga minimalnie 3 liter',
                'lastName.max' => 'Nazwisko maksymalnie 30 liter',
                'pesel.required' => 'Pesel jest wymagany',
                'pesel.min' => 'Pesel 11 powinien zawierać cyfr',
                'pesel.max' => 'Pesel 11 powinien zawierać cyfr',
                'datepicker.required' => 'Podanie daty wizyty jest wymagane',
                'address.required' => 'Podanie adresu jest wymagane',
                 'address.max' => 'Maksymalna liczba liter adresu to 30'
            ]
        );
        if ($validator->fails()) {
            return view('pages/patientInsert', ['data' => $patients])
                ->withErrors($validator);
        }


        //dd($data);/// ZOBACZ SOBIE TO JAK NAPRAWISZ
        $patient = new Patient();

        $patient->first_name = $data['firstName'];
        $patient->last_name = $data['lastName'];
        $patient->pesel = $data['pesel'];
        $patient->date_of_birth = $data['datepicker'];
        $patient->address = $data['address'];

        $patient->save();



        return view('pages/patients', ['data' => $patients])->with(["message" => "Dodano pacjenta!"]);
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