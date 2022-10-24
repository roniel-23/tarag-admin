<?php

namespace App\Http\Controllers;

// use App\Models\CourtOwners;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $current = Carbon::today()->toFormattedDateString();

        $year = (int)$request->input('year');
        if($year == null){$year = Carbon::now()->year;}

        $courtYear = (int)$request->input('court_year');
        if($courtYear == null){$courtYear = Carbon::now()->year;}

        $players = DB::table('players')
            ->latest()
            ->where('delete', '=', 0)
            ->select('user_id', 'photo', 'first_name', 'last_name', 'position', 'code_name')
            ->limit(5)
            ->get();

        $gcoin = DB::table('gcoin_system')
            ->select('gcoin')->first();

        $courtOwners = DB::table('court_owners')
            ->latest()
            ->where('delete', '=', 0)
            ->select('user_id', 'court_images', 'first_name', 'last_name', 'court_name', 'contact_number')
            ->limit(5)
            ->get();
        
        $rooms = DB::table('court_rooms')
            ->where('court_rooms.delete', '=', 0)
            ->where('court_rooms.game_date', '=', Carbon::today())
            ->leftJoin('players', 'court_rooms.user_id', '=', 'players.user_id' )
            ->leftJoin('court_owners', 'court_rooms.court_owner_id', '=', 'court_owners.id')
            ->select(
                'court_rooms.game_date',
                'court_rooms.game_time',
                'court_rooms.room_title',
                'players.first_name',
                'players.last_name',
                'court_owners.court_name')
            ->orderBy('court_rooms.game_time', 'ASC')
            ->get();

        $playersCount = DB::table('players')
            ->where('delete', '=', 0)
            ->count();

        $courtsCount = DB::table('court_owners')
            ->where('delete', '=', 0)
            ->count();

        $roomsCount = DB::table('court_rooms')
            ->where('delete', '=', 0)
            ->where('game_date', '=', Carbon::today())
            ->count();
        
        $playerDataGraph = DB::table("players")
            ->where('delete', '=', 0)
            ->whereYear('created_at', $year )
            ->select(DB::raw("DATE_FORMAT(created_at,'%M') as month"), DB::raw('COUNT(id) as total'))
            ->groupBy('month')
            ->get();

        $playerMonthGraph = DB::table("players")
            ->where('delete', '=', 0)
            ->whereMonth('created_at', Carbon::now()->month )
            ->select(DB::raw("DATE_FORMAT(created_at,'%M %D') as day"), DB::raw('COUNT(id) as total'))
            ->groupBy('day')
            ->get();

        $courtDataGraph = DB::table("court_owners")
            ->where('delete', '=', 0)
            ->whereYear('created_at', $courtYear )
            ->select(DB::raw("DATE_FORMAT(created_at,'%M') as month"), DB::raw('COUNT(id) as total'))
            ->groupBy('month')
            ->get();

        $courtMonthGraph = DB::table("court_owners")
            ->where('delete', '=', 0)
            ->whereMonth('created_at', Carbon::now()->month )
            ->select(DB::raw("DATE_FORMAT(created_at,'%M %D') as day"), DB::raw('COUNT(id) as total'))
            ->groupBy('day')
            ->get();

        $playerYears = DB::table("players")
            ->where('delete', '=', 0)
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y') as year"))
            ->groupBy('year')
            ->orderBy('year', 'ASC')
            ->get();
        
        $courtYears = DB::table("court_owners")
            ->where('delete', '=', 0)
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y') as year"))
            ->groupBy('year')
            ->get();

        return Inertia::render('Dashboard',
        [
        'court_month_graph' => $courtMonthGraph,
        'court_graph' => $courtDataGraph,
        'player_month_graph' => $playerMonthGraph,
        'player_graph' => $playerDataGraph,
        'players' => $players,
        'court_owners' => $courtOwners,
        'rooms' => $rooms,
        'gcoin' => $gcoin,
        'players_count' => $playersCount,
        'courts_count' => $courtsCount,
        'rooms_count' => $roomsCount,
        'player_years' => $playerYears,
        'court_years' => $courtYears,
        'court_year' => $courtYear,
        'year' => $year
        ]);
    }
}
