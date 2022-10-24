<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomPlayersApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoomPlayers($id)
    {
        $roomPlayers = DB::table('court_room_players')
            ->where('court_room_id', '=', $id)
            ->where('delete', '=', 0)
            ->select('position', 'code_name', 'last_name', 'first_name', 'user_id')
            ->get();
        $roomPlayersCount = DB::table('court_room_players')
            ->where('court_room_id', '=', $id)
            ->where('delete', '=', 0)
            ->count();

        return ['room_players' => $roomPlayers, 'room_players_count' => $roomPlayersCount];
    }

}
