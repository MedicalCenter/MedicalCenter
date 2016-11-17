<?php

namespace App\Http\Controllers;

Use DB;
class VisitsController
{
    public function getPendingVisits() {
        $pending = DB::table('pending_visits')->get();
        return view('testing', ['data' => $pending]);
    }

    public function getVisitsOnDay($date) {
        $pending = DB::table('pending_visits')->where('date_of_visit', $date)->get();
        return view('testing', ['data' => $pending]);
    }



}