<?php

namespace App\Http\Controllers;

use App\Models\ResProperties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        return view('home');
    }

    public function search() {
        $school_dist_Lists = ResProperties::select(DB::raw('DISTINCT SCHOOLDISTRICT'))
            ->where('LISTSTATUS','Active')
            ->orderBy('SCHOOLDISTRICT', 'asc')
            ->get();
        //dd($school_dist_Lists);

        $propLists = ResProperties::where('LISTSTATUS','Active')->take(50)->get();

        //dd($propLists);

        return view('search',[
            'school_dist_Lists'=>$school_dist_Lists,
            'propLists'=>$propLists
        ]);
    }
}
