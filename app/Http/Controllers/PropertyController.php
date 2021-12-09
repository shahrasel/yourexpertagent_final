<?php

namespace App\Http\Controllers;

use App\Models\ResProperties;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function property_details(ResProperties $property) {
        //dd($property);
        return view('property_details',[
            'property_info' => $property
        ]);
    }
}
