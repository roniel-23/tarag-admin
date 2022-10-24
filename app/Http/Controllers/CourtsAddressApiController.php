<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourtsAddressApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = DB::table('court_owners_address')->get();
 
        return ['address' => $address];
    }

    public function showAddressByCourt($user_id)
    {
        $court_address = DB::table('court_owners_address')
            ->select('*')
            ->where('user_id', '=', $user_id)
            ->first();
        return $court_address;
    }

}
