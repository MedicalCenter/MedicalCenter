<?php
/**
 * Created by PhpStorm.
 * User: Michal Czarnecki
 * Date: 18.11.2016
 * Time: 18:09
 */

namespace App\Http\Controllers;

Use DB;

class DoctorsController extends Controller
{
    public function getDoctors() {
        $data = DB::table('doctors')->get();
        return view('testing', ['data' => $data]);
    }

    public function getDoctorById($id) {
        $data = DB::table('doctors')->where('id', $id)->get();
        return view('testing', ['data' => $data]);
    }

    public function getDoctorBySpecialization($specialization) {
        $data = DB::table('doctors')->where('specialization', $specialization)->get();
        return view('testing', ['data' => $data]);
    }



}