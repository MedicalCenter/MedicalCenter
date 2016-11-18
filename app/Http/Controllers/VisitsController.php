<?php

namespace App\Http\Controllers;

Use DB;
class VisitsController
{
    public function getPendingVisits() {
        $pending = DB::table('pending_visits')->get();
    }

    public function getPendingVisitsOnDay($date) {
        $pending = DB::table('pending_visits')->where('date_of_visit', $date)->get();
    }

    public function getPendingVisitsOnDayForDoctor($date, $doctorId) {
        $pending =  DB::table('pending_visits')->where([
            ['doctor_id', $doctorId],
            ['date_of_visit', $date]
        ])->get();
    }

    public function getPendingVisitsForPatient($patientId) {
        $pending = DB::table('pending_visits')->where('patient_id', $patientId)->get();
    }
}