<?php

namespace App\Http\Controllers;

use App\Models\Players;
// use App\Models\PlayersAddress;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;
use Illuminate\Support\Facades\DB;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $players = DB::table('players')
            ->where('players.delete', '=', 0)
            ->leftJoin('users', 'players.user_id' , '=' , 'users.id')
            ->select(
                'players.user_id',
                'players.photo',
                'players.first_name',
                'players.last_name',
                'players.position',
                'players.code_name',
                'players.height',
                'players.weight',
                'players.gender',
                'players.gcoin',
                'users.verified'
            )
            ->when($search, function ($query, $search) {
                $query->where('players.first_name', 'like', "%{$search}%");
                $query->orwhere('players.last_name', 'like', "%{$search}%");
            })
            ->orderBy('players.created_at', 'DESC')
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('Players/index', ['players' => $players, 'filter'=> $search]);
    }

    public function verifiedPlayers(Request $request)
    {
        $search = $request->input('search');
        $verified_players = DB::table('players')
            ->leftJoin('users', 'players.user_id' , '=' , 'users.id')
            ->select(
                'players.user_id',
                'players.photo',
                'players.first_name',
                'players.last_name',
                'players.position',
                'players.code_name',
                'players.height',
                'players.weight',
                'players.gender',
                'players.gcoin',
                'users.verified'
            )
            ->where('users.verified', '=', 1)
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%");
                $query->orwhere('last_name', 'like', "%{$search}%");
            })
            ->orderBy('players.created_at', 'DESC')
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('Players/index', ['players' => $verified_players, 'filter'=> $search]);
    }

    public function unverifiedPlayers(Request $request)
    {
        $search = $request->input('search');
        $unverified_players = DB::table('players')
            ->leftJoin('users', 'players.user_id' , '=' , 'users.id')
            ->select(
                'players.user_id',
                'players.photo',
                'players.first_name',
                'players.last_name',
                'players.position',
                'players.code_name',
                'players.height',
                'players.weight',
                'players.gender',
                'players.gcoin',
                'users.verified'
            )
            ->where('users.verified', '=', 0)
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%");
                $query->orwhere('last_name', 'like', "%{$search}%");
            })
            ->orderBy('players.created_at', 'DESC')
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('Players/index', ['players' => $unverified_players, 'filter'=> $search]);
    }

    public function deletePlayer($user_id)
    {
        $player = DB::table('players')
            ->where('user_id', '=', $user_id)
            ->update(['delete' => 1]);

        $user = DB::table('users')
            ->where('id', '=', $user_id)
            ->update(['delete' => 1]);

            return Redirect::route('players');
    }

    public function verifyUser($user_id){
        $user = DB::table('users')
              ->where('id', $user_id)
              ->update(['verified' => 1]);

        // $player = DB::table('players')
        //       ->where('user_id', $user_id)
        //       ->update(['verified' => 1]);

              return Redirect::route('player.show', $user_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $player = DB::table('players')
            ->where('players.user_id', '=', $user_id)
            ->leftJoin('users', 'players.user_id' , '=' , 'users.id')
            ->select(
                'players.user_id',
                'players.photo',
                'players.first_name',
                'players.last_name',
                'players.position',
                'players.code_name',
                'players.height',
                'players.weight',
                'players.gender',
                'players.gcoin',
                'players.gcoin_reward',
                'users.verified'
            )
            ->first();

        return Inertia::render('Players/PlayerInformation', ['player' => $player]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
