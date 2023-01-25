<?php

namespace App\Http\Controllers;

// use App\Models\CourtOwners;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;
use Illuminate\Support\Facades\DB;

class CourtOwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $courts = DB::table('court_owners')
            ->where('court_owners.delete', '=', 0)
            ->leftJoin('users', 'court_owners.user_id' , '=' , 'users.id')
            ->select(
                'court_owners.user_id',
                'court_owners.court_images',
                'court_owners.first_name',
                'court_owners.last_name',
                'court_owners.contact_number',
                'court_owners.gender',
                'court_owners.court_name',
                'court_owners.gcoin',
                'court_owners.delete',
                'users.verified'
            )
            ->orderBy('court_owners.created_at', 'DESC')
            ->when($search, function ($query, $search) {
                $query->where('court_name', 'like', "%{$search}%");
            })
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('CourtOwners/index', ['courts' => $courts, 'filter'=> $search]);
    }

    public function verifiedCourts(Request $request)
    {
        $search = $request->input('search');
        $verified_courts = DB::table('court_owners')
            ->where('court_owners.delete', '=', 0)
            ->leftJoin('users', 'court_owners.user_id' , '=' , 'users.id')
            ->select(
                'court_owners.user_id',
                'court_owners.court_images',
                'court_owners.first_name',
                'court_owners.last_name',
                'court_owners.contact_number',
                'court_owners.gender',
                'court_owners.court_name',
                'court_owners.gcoin',
                'court_owners.delete',
                'users.verified'
            )
            ->where('users.verified', '=', 1)
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%");
                $query->orwhere('last_name', 'like', "%{$search}%");
            })
            ->orderBy('court_owners.created_at', 'DESC')
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('CourtOwners/index', ['courts' => $verified_courts, 'filter'=> $search]);
    }

    public function unverifiedCourts(Request $request)
    {
        $search = $request->input('search');
        $unverified_courts = DB::table('court_owners')
            ->where('court_owners.delete', '=', 0)
            ->leftJoin('users', 'court_owners.user_id' , '=' , 'users.id')
            ->select(
                'court_owners.user_id',
                'court_owners.court_images',
                'court_owners.first_name',
                'court_owners.last_name',
                'court_owners.contact_number',
                'court_owners.gender',
                'court_owners.court_name',
                'court_owners.gcoin',
                'court_owners.delete',
                'users.verified'
            )
            ->whereNot('users.verified', '=', 1)
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%");
                $query->orwhere('last_name', 'like', "%{$search}%");
            })
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('CourtOwners/index', ['courts' => $unverified_courts, 'filter'=> $search]);
    }

    public function bin(Request $request)
    {
        $search = $request->input('search');
        $deletedCourts = DB::table('court_owners')
            ->where('court_owners.delete', '=', 1)
            ->leftJoin('users', 'court_owners.user_id' , '=' , 'users.id')
            ->select(
                'court_owners.user_id',
                'court_owners.court_images',
                'court_owners.first_name',
                'court_owners.last_name',
                'court_owners.contact_number',
                'court_owners.gender',
                'court_owners.court_name',
                'court_owners.gcoin',
                'court_owners.delete',
                'users.verified'
            )
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%");
                $query->orwhere('last_name', 'like', "%{$search}%");
            })
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('CourtOwners/index', ['courts' => $deletedCourts, 'filter'=> $search]);
    }

    public function recoverCourt($user_id)
    {
        $court = DB::table('court_owners')
            ->where('user_id', '=', $user_id)
            ->update(['delete' => 0]);

        $user = DB::table('users')
            ->where('id', '=', $user_id)
            ->update(['delete' => 0]);

            return Redirect::route('courts');
    }

    public function deleteCourt($user_id)
    {
        $court = DB::table('court_owners')
            ->where('user_id', '=', $user_id)
            ->update(['delete' => 1]);

        $user = DB::table('users')
            ->where('id', '=', $user_id)
            ->update(['delete' => 1]);

            return Redirect::route('courts');
    }

    public function permanentDeleteCourt($user_id)
    {
        $court = DB::table('court_owners')
            ->where('user_id', '=', $user_id)
            ->delete();

        $user = DB::table('users')
            ->where('id', '=', $user_id)
            ->delete();

            return Redirect::route('courts');
    }

    public function verifyCourt($user_id){
        $user = DB::table('users')
              ->where('id', $user_id)
              ->update(['verified' => 1]);

        return Redirect::route('court.show', $user_id);
    }

    public function requestID($user_id){
        $user = DB::table('users')
              ->where('id', $user_id)
              ->update(['verified' => 2]);

        return Redirect::route('court.show', $user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $court = DB::table('court_owners')
            ->where('court_owners.user_id', '=', $user_id)
            ->leftJoin('users', 'court_owners.user_id' , '=' , 'users.id')
            ->select(
                'court_owners.id',
                'court_owners.user_id',
                'court_owners.court_images',
                'court_owners.first_name',
                'court_owners.last_name',
                'court_owners.contact_number',
                'court_owners.gender',
                'court_owners.court_name',
                'court_owners.gcoin',
                'users.verified'
            )->first();

        return Inertia::render('CourtOwners/CourtInformation', ['court' => $court]);
    }
}
