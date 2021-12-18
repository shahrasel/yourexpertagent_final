<?php

namespace App\Http\Controllers;

use App\Models\ResProperties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function property_details(ResProperties $property) {

        $similarLists = ResProperties::where('CITY',$property->CITY)
            ->where('BEDS',$property->BEDS)
            ->where('BATHSFULL',$property->BATHSFULL)
            ->where('GARAGECAP',$property->GARAGECAP)
            ->where('MLSNUM','<>',$property->MLSNUM)
            ->whereBetween('SQFTTOTAL',[($property->SQFTTOTAL-300),($property->SQFTTOTAL+300)])->take(10)->get();
        //dd(DB::table('crime_report')->where('city',$property->CITY)->first());

        return view('property_details',[
            'property_info' => $property,
            'similarLists' => $similarLists,
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
}
