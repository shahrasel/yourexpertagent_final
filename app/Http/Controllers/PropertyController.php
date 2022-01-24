<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\ResProperties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function property_details(ResProperties $property) {

        $similarLists = ResProperties::where('CITY',$property->CITY)
            ->where('LISTSTATUS','Sold')
            ->where('BEDS',$property->BEDS)
            ->where('BATHSFULL',$property->BATHSFULL)
            ->where('GARAGECAP',$property->GARAGECAP)
            ->where('MLSNUM','<>',$property->MLSNUM)
            ->whereBetween('LISTPRICE',[($property->LISTPRICE-100000),($property->LISTPRICE+100000)])
            ->whereBetween('SQFTTOTAL',[($property->SQFTTOTAL-200),($property->SQFTTOTAL+200)])->take(10)->get();


        $similarPriceLists = ResProperties::select('LISTPRICE')
            ->where('CITY',$property->CITY)
            ->where('ZIPCODE',$property->ZIPCODE)
            ->where('LISTSTATUS','Sold')
            ->where('BEDS',$property->BEDS)
            ->where('BATHSFULL',$property->BATHSFULL)
            ->where('GARAGECAP',$property->GARAGECAP)
            ->where('MLSNUM','<>',$property->MLSNUM)
            ->whereBetween('SQFTTOTAL',[($property->SQFTTOTAL-100),($property->SQFTTOTAL+100)])->get();

        $final_estimated_price = 0;
        if(!empty($similarPriceLists)) {
            $estimated_price = 0;
            foreach($similarPriceLists as $similarPriceList) {
                $estimated_price += $similarPriceList['LISTPRICE'];
            }

            if($similarPriceLists->count() !=0 && $estimated_price != 0)
                $final_estimated_price = $estimated_price/$similarPriceLists->count();
        }

        return view('property_details',[
            'property_info' => $property,
            'similarLists' => $similarLists,
            'estimated_price' => round($final_estimated_price),
            'crime_report' => DB::table('crime_report')->where('city',$property->CITY)->first()
        ]);
    }

    public function get_gmap_amenities(Request $request) {
        if(!empty($request->input('amenity')) && !empty($request->input('latitude')) && !empty($request->input('longitude'))) {

            $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$request->input('latitude').",".$request->input('longitude')."&radius=3000&type=".$request->input('amenity')."&key=AIzaSyAFqAPWaxVQnJMkCBEHvlP1fIqevvgoN44";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

            $result = curl_exec($ch);
            curl_close($ch);

            $final_result = json_decode($result);

            $main_arr = array();
            $arr = array();
            if (!empty($final_result->results)) {
                $i = 0;
                foreach ($final_result->results as $result) {
                    $arr[$i][0] = $result->name;
                    $arr[$i][1] = $result->geometry->location->lat;
                    $arr[$i][2] = $result->geometry->location->lng;
                    $arr[$i][3] = $i + 1;
                    $arr[$i][4] = $result->vicinity;

                    $i++;
                }
                echo json_encode($arr);
            }
        }
    }

    public function add_remove_fav(Request $request) {
        if(!empty($request->input('userid')) && !empty($request->input('mlsnum'))) {
            $is_exists = Bookmark::where('MLSNUM', $request->input('mlsnum'))
                                    ->where('user_id', $request->input('userid'))
                                    ->first();


            if(!empty($is_exists)) {
                $bookmark = Bookmark::destroy($is_exists->id);

                echo 'removed';
                exit;
            }
            else {
                $bookmark = new Bookmark();
                $bookmark->user_id = $request->input('userid');
                $bookmark->MLSNUM = $request->input('mlsnum');
                $bookmark->save();

                echo 'added';
                exit;
            }


        }
    }

    public function compareProperties(Request $request)
    {
        $property1 = array();
        $property2 = array();
        $property3 = array();

        if(!empty($request->input('property1'))) {
            $property1 = ResProperties::where('MLSNUM', $request->input('property1'))->first();
        }

        if(!empty($request->input('property2'))) {
            $property2 = ResProperties::where('MLSNUM', $request->input('property2'))->first();
        }

        if(!empty($request->input('property3'))) {
            $property3 = ResProperties::where('MLSNUM', $request->input('property3'))->first();
        }
        //dd($property1);
        return view('compare',[
            'property1' => $property1,
            'property2' => $property2,
            'property3' => $property3
        ]);
    }
}
