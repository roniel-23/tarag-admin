<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\JoinClause;
use Inertia\Inertia;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GCoinTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $event = $request->input('event');
        $filter = $request->input('filter');
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $playersTotalGcoin = DB::table('players')
            ->where('delete', '=', 0)
            ->sum('gcoin');
        
        $courtsTotalGcoin = DB::table('court_owners')
            ->where('delete', '=', 0)
            ->sum('gcoin');

        $gcoin = DB::table('gcoin_system')
            ->select('gcoin', 'gcoin_payback')
            ->first();

        $transactions = DB::table('gcoin_transactions')
            ->leftJoin('players as sender', 'gcoin_transactions.user_id', '=', 'sender.user_id')
            ->leftJoin('players as receiver_player', 'gcoin_transactions.other_player_id', '=', 'receiver_player.user_id' )
            ->leftJoin('court_owners as receiver_court', 'gcoin_transactions.other_player_id', '=', 'receiver_court.user_id' )
            ->select(
                'gcoin_transactions.amount',
                'gcoin_transactions.event',
                'gcoin_transactions.reference_no',
                'gcoin_transactions.created_at',
                'sender.first_name as sender_first_name',
                'sender.last_name as sender_last_name',
                'receiver_player.first_name as player_first_name',
                'receiver_player.last_name as player_last_name',
                'receiver_court.first_name as court_first_name',
                'receiver_court.last_name as court_last_name')
            ->where('gcoin_transactions.delete', '=', 0)

            ->where(function ($query) use($filter) {
                $query->where('sender.first_name', 'like', "%{$filter}%");
                $query->orwhere('sender.last_name', 'like', "%{$filter}%");
                $query->orwhere('receiver_player.first_name', 'like', "%{$filter}%");
                $query->orwhere('receiver_player.last_name', 'like', "%{$filter}%");
                $query->orwhere('receiver_court.first_name', 'like', "%{$filter}%");
                $query->orwhere('receiver_court.last_name', 'like', "%{$filter}%");
                $query->orwhere('gcoin_transactions.reference_no', 'like', "%{$filter}%");
            })
            
            ->when($date_from && $date_to, function($query) use($date_from, $date_to) {
                $query->whereBetween('gcoin_transactions.created_at', [$date_from, $date_to]);
            })

            ->when($event, function ($query, $event) {
                $query->where('gcoin_transactions.event', 'like', "%{$event}%");
            })

            ->orderBy('gcoin_transactions.created_at', 'DESC')
            ->limit(100)
            ->get();

        return Inertia::render('GCoin/index', ['transactions' => $transactions, 'players_total_gcoin' => $playersTotalGcoin, 'courts_total_gcoin' => $courtsTotalGcoin, 'gcoin' => $gcoin]);
    }

    public function sendToPlayer(Request $request){

        $year = Carbon::now()->year;
        $reference = random_int(100000, 999999);
        $reference_exist = true;

        while($reference_exist){
            $count_reference = DB::table('gcoin_transactions')->where('reference_no','=', $reference) -> count();
            if($count_reference>0){
                $reference_exist = true;
                $reference = random_int(100000, 999999);
            } else {
                $reference_exist = false;
            }
        }

        $final_reference = (string)$year . (string)$reference;

        $player = DB::table('players')
            ->where('user_id', '=', $request->userID)
            ->increment('gcoin', $request->amount);

        $courtOwner = DB::table('court_owners')
            ->where('user_id', '=', $request->userID)
            ->increment('gcoin', $request->amount);
        
        DB::table('gcoin_transactions')->insert([
            ['other_player_id' => $request->userID,
                'amount' => $request->amount,
                'event' => 'Tara G! Transfer',
                'user_id' => $request->adminID,
                'reference_no' => $final_reference
            ]
        ]);

        DB::table('gcoin_system')
            ->decrement('gcoin', $request->amount);

        return Redirect::route('gcointransaction');
    }
}
