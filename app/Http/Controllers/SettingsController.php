<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings_data = DB::table('settings')
            ->select('player_transaction_limit', 
            'payment_percentage',
            'app_description')
            ->first();

        return Inertia::render('Settings/index', ['settings' => $settings_data]);
    }

    public function updateTransaction(Request $request) {

        $limit = $request->input('limit');
        $percent = $request->input('percent');

        DB::table('settings')
        ->update(['player_transaction_limit' => $limit, 'payment_percentage' => $percent]);

        return Redirect::route('settings');
    }

    public function updateLandingPage(Request $request) {

        $description = $request->input('description');

        DB::table('settings')
        ->update(['app_description' => $description]);

        return Redirect::route('settings');
    }
    
}
