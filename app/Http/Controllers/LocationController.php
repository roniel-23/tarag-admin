<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $province_id = $request->input('selectedProvince');
        $municipality_id = $request->input('selectedMunicipality');

        $provinces = DB::table('tariff_provinces')
            ->where('delete', '=', 0)
            ->select('id', 'province as name')
            ->orderBy('name', 'asc')
            ->get();

        $municipalities = DB::table('tariff_municipalities')
            ->where('delete', '=', 0)
            ->select('id', 'province_id', 'municipality as name')
            ->where('province_id', '=', $province_id)
            ->orderBy('name', 'asc')
            ->get();

        $barangays = DB::table('tariff_barangays')
            ->where('delete', '=', 0)
            ->select('id', 'province_id', 'municipality_id', 'barangay as name')
            ->where('municipality_id', '=', $municipality_id)
            ->orderBy('name', 'asc')
            ->get();


        return Inertia::render('Location/index', ['provinces' => $provinces, 'municipalities' => $municipalities, 'barangays' => $barangays]);
    }

    public function addProvince(Request $request)
    {
        $check_province = DB::table('tariff_provinces')->where('province','=', $request->province) -> count();

        if($check_province == 0){
            DB::table('tariff_provinces')
            ->insert(['province' => $request->province]);
        }
    }

    public function deleteProvince(Request $request)
    {
        DB::table('tariff_provinces')
        ->where('id', '=', $request->province_id)
        ->update(['delete' => 1]);

        DB::table('tariff_municipalities')
        ->where('province_id', '=', $request->province_id)
        ->update(['delete' => 1]);

        DB::table('tariff_barangays')
        ->where('province_id', '=', $request->province_id)
        ->update(['delete' => 1]);

        return Redirect::route('location');
    }

    public function editProvince(Request $request)
    {
         DB::table('tariff_provinces')
         ->where('id', '=', $request->id)
        ->update(['province' => $request->name]);
    }


    public function addMunicipality(Request $request)
    {
        $check_municipality = DB::table('tariff_municipalities')->where('municipality','=', $request->name) -> count();
        if($check_municipality == 0){
            DB::table('tariff_municipalities')
            ->insert([
                'province_id'=>$request->province_id,
                'municipality' => $request->name
            ]);
        }
    }

    public function deleteMunicipality(Request $request)
    {
        DB::table('tariff_municipalities')
        ->where('id', '=', $request->municipality_id)
        ->update(['delete' => 1]);

        DB::table('tariff_barangays')
        ->where('municipality_id', '=', $request->municipality_id)
        ->update(['delete' => 1]);
    }

    public function editMunicipality(Request $request)
    {
         DB::table('tariff_municipalities')
         ->where('id', '=', $request->id)
        ->update(['municipality' => $request->name]);
    }

    public function addBarangay(Request $request)
    {
        $check_barangay = DB::table('tariff_barangays')->where('barangay','=', $request->name) -> count();
        if($check_barangay == 0){
            DB::table('tariff_barangays')
            ->insert([
                'province_id'=>$request->province_id,
                'municipality_id'=>$request->municipality_id,
                'barangay' => $request->name
            ]);
        }
    }

    public function deleteBarangay(Request $request)
    {
        DB::table('tariff_barangays')
        ->where('id', '=', $request->barangay_id)
        ->update(['delete' => 1]);
    }

    public function editBarangay(Request $request)
    {
         DB::table('tariff_barangays')
         ->where('id', '=', $request->id)
        ->update(['barangay' => $request->name]);
    }
}
