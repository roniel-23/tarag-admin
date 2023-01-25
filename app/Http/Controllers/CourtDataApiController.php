<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourtDataApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCourtData($id)
    {
        $courtRate = DB::table('court_rates')
            ->where('court_owner_id', '=', $id)
            ->select('price_rate')
            ->first();
        if($courtRate == null){$courtRate=0;}

        $courtRooms = DB::table('court_rooms')
            ->where('court_rooms.court_owner_id', '=', $id)
            ->where('court_rooms.delete', '=', '0')
            ->select('room_title', 'game_date', 'game_time', 'number_of_players', 'last_name', 'first_name')
            ->leftJoin('players', 'court_rooms.user_id', '=' ,'players.user_id')
            ->orderBy('game_date', 'DESC')
            ->orderBy('game_time', 'ASC')
            ->get();
        
        $roomCount = DB::table('court_rooms')
            ->where('court_owner_id', '=', $id)
            ->where('delete', '=', '0')
            ->count();
 
        return ['rate' => $courtRate, 'rooms' => $courtRooms, 'total_room' => $roomCount];
    }

}
