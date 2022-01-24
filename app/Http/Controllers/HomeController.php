<?php

namespace App\Http\Controllers;

use App\Models\ResProperties;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        //dd(Auth::user());
        return view('home');
    }

    public function search(Request $request) {
        //dd($request);
        $school_dist_Lists = ResProperties::select(DB::raw('DISTINCT SCHOOLDISTRICT'))
            ->where('LISTSTATUS','Active')
            ->orderBy('SCHOOLDISTRICT', 'asc')
            ->get();
        //dd($school_dist_Lists);

        //$propLists = ResProperties::where('LISTSTATUS','Active')->take(50)->get();
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        $min_bed = $request->input('min_beds');
        $min_bath = $request->input('min_baths');

        $city = explode(', ',$request->input('city_zip'))[0];

        $school_district = $request->input('school_district');
        $min_garage = $request->input('min_garage');
        $min_built_year = $request->input('min_built_year');
        $minsq = $request->input('minsq');
        $maxsq = $request->input('maxsq');
        $minlot = $request->input('minlot');
        $maxlot = $request->input('maxlot');

        $quick_move_in = $request->input('quick_move_in');
        $new_listing = $request->input('new_listing');
        $open_house = $request->input('open_house');
        $two_storied = $request->input('two_storied');
        $price_reduced = $request->input('price_reduced');
        $lots_only = $request->input('lots_only');

        $propLists = DB::table('res_properties')
            ->when($min_price, function ($query, $min_price) {
                return $query->where('LISTPRICE', '>', $min_price);
            })
            ->when($max_price, function ($query, $max_price) {
                return $query->where('LISTPRICE', '<', $max_price);
            })
            ->when($min_bed, function ($query, $min_bed) {
                return $query->where('BEDS', '>=', $min_bed);
            })
            ->when($min_bath, function ($query, $min_bath) {
                return $query->where('BATHSFULL', '>=', $min_bath);
            })
            ->when($city, function ($query, $city) {
                return $query->where('CITY', $city);
            })
            ->when($school_district, function ($query, $school_district) {
                return $query->where('SCHOOLDISTRICT', $school_district);
            })
            ->when($min_garage, function ($query, $min_garage) {
                return $query->where('GARAGECAP', '>=', $min_garage);
            })
            ->when($min_built_year, function ($query, $min_built_year) {
                return $query->where('YEARBUILT', '>=', $min_built_year);
            })
            ->when($minsq, function ($query, $minsq) {
                return $query->where('SQFTTOTAL', '>', $minsq);
            })
            ->when($maxsq, function ($query, $maxsq) {
                return $query->where('SQFTTOTAL', '<', $maxsq);
            })
            ->when($minlot, function ($query, $minlot) {
                return $query->where('LotSizeArea', '>', $minlot);
            })
            ->when($two_storied, function ($query, $two_storied) {
                return $query->where('STORIES', $two_storied);
            })
            ->when($price_reduced, function ($query, $price_reduced) {
                return $query->where('LISTPRICEORIG', '>', 'LISTPRICE');
            })
            ->when($new_listing, function ($query, $new_listing) {
                return $query->where('created', '>=', Carbon::now()->subDays(14)->toDateTimeString());
            })
            ->take(50)
            ->get();

        //dd($propLists);

        return view('search',[
            'school_dist_Lists'=>$school_dist_Lists,
            'propLists'=>$propLists
        ]);
    }
}
