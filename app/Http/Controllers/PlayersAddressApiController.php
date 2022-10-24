<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PlayersAddress;
use App\Http\Resources\PlayersAddressResource;

class PlayersAddressApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = DB::table('players_address')->get();
 
        return ['address' => $address];
    }

    public function showAddressByPlayer($user_id)
    {
        $player_address = DB::table('players_address')
            ->select('*')
            ->where('user_id', '=', $user_id)
            ->first();
        return $player_address;
        // return compact('player_address');
    }

}
