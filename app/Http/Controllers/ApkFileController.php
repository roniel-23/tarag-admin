<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
 
class ApkFileController extends Controller
{
    /**
     * Update the avatar for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $name = $request->input('name');
        $name = $name . '.apk';
        // $request->file('avatar')->getClientOriginalName();
        DB::table('settings')
            ->update(['app_name' => $name]);

        Storage::disk('public')->putFileAs(
            'apk', $request->file('apk'),  $name
        );

        return Redirect::route('settings');
    }

    public function download()
    {
        $name = DB::table('settings')
            ->select('app_name')->value('app_name');
        $path = '/apk/'.$name;
        return Storage::disk('public')->download($path);

    }
}