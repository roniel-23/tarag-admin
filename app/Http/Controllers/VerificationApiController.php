<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;

class VerificationApiController extends Controller
{
    public function showVerifiedPlayers()
    {
        $allPlayersCount = DB::table('players')
            ->where('delete', '=', 0)
            ->count();
        
        $verified_playersCount = DB::table('players')
            ->leftJoin('users', 'players.user_id' , '=' , 'users.id')
            ->where([
                ['players.delete', '=', 0],
                ['users.verified', '=', 1]
            ])->count();

        $unverified_playersCount = DB::table('players')
            ->leftJoin('users', 'players.user_id' , '=' , 'users.id')
            ->where([
                ['players.delete', '=', 0],
                ['users.verified', '=', 0]
            ])->count();

        return ['all_players' => $allPlayersCount, 'verified_players' => $verified_playersCount, 'unverified_players' => $unverified_playersCount];
    }

    public function showVerifiedCourts()
    {
        $allCourtsCount = DB::table('court_owners')
            ->where('delete', '=', 0)
            ->count();
        
        $verified_courtsCount = DB::table('court_owners')
            ->leftJoin('users', 'court_owners.user_id' , '=' , 'users.id')
            ->where([
                ['court_owners.delete', '=', 0],
                ['users.verified', '=', 1]
            ])->count();

        $unverified_courtsCount = DB::table('court_owners')
            ->leftJoin('users', 'court_owners.user_id' , '=' , 'users.id')
            ->where([
                ['court_owners.delete', '=', 0],
                ['users.verified', '=', 0]
            ])->count();

        return ['all_courts' => $allCourtsCount, 'verified_courts' => $verified_courtsCount, 'unverified_courts' => $unverified_courtsCount];
    }

    public function getUserName($user_id){

        $userPlayer = DB::table('players')
            ->where('user_id', '=', $user_id)
            ->select('first_name', 'last_name', 'photo')
            ->first();
        $userCourtOwner = DB::table('court_owners')
            ->where('user_id', '=', $user_id)
            ->select('first_name', 'last_name', 'court_images as photo')
            ->first();

        if($userPlayer == null){
            $user = $userCourtOwner;
        }else{ $user = $userPlayer; }
        return $user;
    }

}
