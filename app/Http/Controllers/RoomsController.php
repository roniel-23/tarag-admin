<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $rooms = DB::table('court_rooms')
            ->where('court_rooms.game_date', '>=', Carbon::today())
            ->leftJoin('players', 'court_rooms.user_id', '=', 'players.user_id' )
            ->leftJoin('court_owners', 'court_rooms.court_owner_id', '=', 'court_owners.id')
            ->select(
                'court_rooms.id',
                'court_rooms.game_date',
                'court_rooms.game_time',
                'court_rooms.number_of_players',
                'court_rooms.room_title',
                'players.first_name',
                'players.last_name',
                'court_owners.court_name')
            ->orderBy('court_rooms.game_date', 'ASC')
            ->orderBy('court_rooms.game_time', 'ASC')
            ->when($search, function ($query, $search) {
                $query->where('court_rooms.room_title', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Rooms/index', ['rooms' => $rooms, 'filter' => $search]);
    }
}
