@extends('layouts.app_search')
@section('style_sheets')
    <style>
        #map-canvas {
            height: 90%;
            margin: 0px;
            padding: 0px
        }
        #markers_info .marker {
            height: 40px;
            cursor: pointer;
        }

        .gm-style-iw {
            width: 300px !important;
            top: 0px !important;
            left: 33px !important;
        }
        #iw-container {
            margin-bottom: 10px;
        }
        #iw-container .iw-title {
            padding: 10px;
            margin: 0;
        }
        #iw-container .iw-content {
            margin-right: 1px;
            padding: 15px 5px 20px 15px;
            max-height: 140px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .iw-content img {
            float: right;
            margin: 0 5px 5px 10px;
        }
        .iw-subTitle {
            padding: 5px 0;
        }
        .iw-bottom-gradient {
            position: absolute;
            width: 326px;
            height: 25px;
            bottom: 10px;
            right: 18px;
        }

        .form-group {
            margin-bottom: 8px;
        }

        .gm-style-iw + div {display: none;}

        .map-base-filter {
            background-color: #fff;
            height: 50px;
            left: 0;
            line-height: 50px;
        }
        .map-base-filter > li:first-child {
            border-left: 0 none;
        }
        .map-base-filter > li.select {
            color: #00aeef;
            line-height: 50px;
            padding: 0 12px 0 15px;
            list-style:outside none none;
        }
        .map-base-filter > li {
            float: left;
            white-space: nowrap;
            list-style:outside none none;
        }

        .map-base-filter > li > label {
            margin-left: 5px;
        }
        .movomap.map-fluid .enhanced-select {
            -moz-user-select: none;
            cursor: pointer;
            display: inline-block;
            padding-right: 1.5em;
            position: relative;
        }
        .map-base-filter select {
            border: 0 none;
            font-weight: bold;
            height: 48px;
            padding-left: 0.5em;
            padding-right: 0.5em;
            vertical-align: top;
            width: inherit;
            font-weight:normal;
        }
        .movomap.map-fluid .enhanced-select select {
            display: none;
        }
        .movomap.map-fluid select {
            border-radius: 5px;
            color: #2759a4;
        }
        table {
            margin-bottom: 8px;
            margin-top: 8px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            float:right;
        }

        .switch input {display:none;}

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #E66300;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{
            background:none;
            border:none;
        }

        .ui-state-active,
        .ui-widget-content .ui-state-active,
        .ui-widget-header .ui-state-active,
        a.ui-button:active,
        .ui-button:active,
        .ui-button.ui-state-active:hover {
            background:none;
            border:none;
        }

        .ui-state-hover,
        .ui-widget-content .ui-state-hover,
        .ui-widget-header .ui-state-hover,
        .ui-state-focus,
        .ui-widget-content .ui-state-focus,
        .ui-widget-header .ui-state-focus,
        .ui-button:hover,
        .ui-button:focus {
            background:none;
            border:none;
        }
        #section-body{
            min-height:auto;
        }

        #section-body.houzez-body-half .property-listing .item-wrap {
            width:100%;
        }

        .property_col {
            min-width:380px;
        }
        #more_search_div{
            top: 149px;
        }
        body {
            overflow:hidden;
        }
        #map_sor_filter {
            display:none;
        }
        #mapview {
            display:block;
        }
        #listview {
            display:block;
        }
        .resfil{
            width:200px !important;
        }
        .closefil{
            width:200px !important;
        }
        .subfil{
            width:200px !important;
        }
        @media (min-width: 768px) and (max-width: 991px) {
            body {
                overflow:hidden !important;
            }
            #more_search_div{
                top: 175px;
            }
            #mapview {
                display:block;
            }
            #listview {
                display:block;
            }
            .resfil{
                width:150px !important;
            }
            .closefil{
                width:150px !important;
            }
            .subfil{
                width:150px !important;
            }
        }
        @media (max-width: 767px) {
            body {
                overflow:auto !important;
            }
            #more_search_div{
                top: 232px;
            }
            #map_sor_filter {
                display:block;
            }
            #mapview {
                display:block;
            }
            #listview {
                display:block;
            }
            .resfil{
                width:100px !important;
            }
            .closefil{
                width:100px !important;
            }
            .subfil{
                width:100px !important;
            }
        }
        .pagination > li > a, .pagination > li > span{
            background-color:#eee;
        }
        .pagination > .disabled > span, .pagination > .disabled > span:hover, .pagination > .disabled > span:focus, .pagination > .disabled > a, .pagination > .disabled > a:hover, .pagination > .disabled > a:focus{
            background-color:#eee;
        }
        .pagination-main .pagination{
            margin-bottom: 15px;
            margin-top: 10px;
        }
        #houzez-gmap-main .map-next-prev-actions{
            right:120px;
        }
        .google_map_labels{
            font-size:12px;
            color:#000;
        }

        @media (max-width: 767px) {
            .dropdown-menu > li > a {
                padding: 6px 6px !important;
                font-size: 12px;
            }
            .col-md-4, .col-sm-6, .col-xs-12{
                padding-right:5px;
                padding-left:5px;
            }
            .bootstrap-select .btn.btn-default {
                font-size: 13px !important;
            }
            .bootstrap-select > .dropdown-toggle {
                padding: 0 25px 0 6px;
            }
        }

        .gm-style .gm-style-iw-c{
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0) !important;
            background-color: transparent !important;
            padding: 0px !important;
        }

        .gm-style .gm-ui-hover-effect {
            display: none !important;
        }

        .gm-style .gm-style-iw-t::after{
            display: none !important;
        }

        .mCSB_inside > .mCSB_container {
            margin-right: 1px !important;
        }

        .gm-style-iw-d {
            overflow: hidden !important;
        }

    </style>
@endsection
@section('content')
    <form action="" method="get" id="searchform">
        <section class="no-padding">
            <section class="section-detail-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 no-padding" style="border-top: 1px solid rgb(0, 66, 116); border-bottom: 1px solid rgb(0, 66, 116); padding: 0px 15px; display: inline-block;background-color:#FFF">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <table cellpadding="5" cellspacing="5" width="100%">
                                    <tr>
                                        <td width="15%">
                                            <select class="selectpicker" id="min_price" data-live-search="false" data-live-search-style="begins" title="Any" name="min_price">
                                                <option value="" data-default="" selected="">Min Price</option>
                                                <option value="100000" @if(app('request')->input('min_price') == '100000') selected @endif>
                                                    $100K
                                                </option>

                                                <option value="125000" @if(app('request')->input('min_price') == '125000') selected @endif>
                                                    $125K
                                                </option>

                                                <option value="150000" @if(app('request')->input('min_price') == '150000') selected @endif>
                                                    $150K
                                                </option>

                                                <option value="175000" @if(app('request')->input('min_price') == '175000') selected @endif>
                                                    $175K
                                                </option>

                                                <option value="200000" @if(app('request')->input('min_price') == '200000') selected @endif>
                                                    $200K
                                                </option>

                                                <option value="225000" @if(app('request')->input('min_price') == '225000') selected @endif>
                                                    $225K
                                                </option>

                                                <option value="250000" @if(app('request')->input('min_price') == '250000') selected @endif>
                                                    $250K
                                                </option>

                                                <option value="275000" @if(app('request')->input('min_price') == '275000') selected @endif>
                                                    $275K
                                                </option>

                                                <option value="300000" @if(app('request')->input('min_price') == '300000') selected @endif>
                                                    $300K
                                                </option>

                                                <option value="325000" @if(app('request')->input('min_price') == '325000') selected @endif>
                                                    $325K
                                                </option>

                                                <option value="350000" @if(app('request')->input('min_price') == '350000') selected @endif>
                                                    $350K
                                                </option>

                                                <option value="375000" @if(app('request')->input('min_price') == '375000') selected @endif>
                                                    $375K
                                                </option>

                                                <option value="400000" @if(app('request')->input('min_price') == '400000') selected @endif>
                                                    $400K
                                                </option>

                                                <option value="450000" @if(app('request')->input('min_price') == '450000') selected @endif>
                                                    $450K
                                                </option>

                                                <option value="500000" @if(app('request')->input('min_price') == '500000') selected @endif>
                                                    $500K
                                                </option>

                                                <option value="550000" @if(app('request')->input('min_price') == '100000') selected @endif>
                                                    $550K
                                                </option>

                                                <option value="600000" @if(app('request')->input('min_price') == '600000') selected @endif>
                                                    $600K
                                                </option>

                                                <option value="650000" @if(app('request')->input('min_price') == '650000') selected @endif>
                                                    $650K
                                                </option>

                                                <option value="700000" @if(app('request')->input('min_price') == '700000') selected @endif>
                                                    $700K
                                                </option>

                                                <option value="800000" @if(app('request')->input('min_price') == '800000') selected @endif>
                                                    $800K
                                                </option>

                                                <option value="900000" @if(app('request')->input('min_price') == '900000') selected @endif>
                                                    $900K
                                                </option>

                                                <option value="1000000" @if(app('request')->input('min_price') == '1000000') selected @endif>
                                                    $1M
                                                </option>

                                                <option value="1250000" @if(app('request')->input('min_price') == '1250000') selected @endif>
                                                    $1.25M
                                                </option>

                                                <option value="1500000" @if(app('request')->input('min_price') == '1500000') selected @endif>
                                                    $1.5M
                                                </option>

                                                <option value="1750000" @if(app('request')->input('min_price') == '1750000') selected @endif>
                                                    $1.75M
                                                </option>

                                                <option value="2000000" @if(app('request')->input('min_price') == '2000000') selected @endif>
                                                    $2M
                                                </option>

                                                <option value="2250000" @if(app('request')->input('min_price') == '2250000') selected @endif>
                                                    $2.25M
                                                </option>

                                                <option value="2500000" @if(app('request')->input('min_price') == '2500000') selected @endif>
                                                    $2.5M
                                                </option>

                                                <option value="2750000" @if(app('request')->input('min_price') == '2750000') selected @endif>
                                                    $2.75M
                                                </option>

                                                <option value="3000000" @if(app('request')->input('min_price') == '3000000') selected @endif>
                                                    $3M
                                                </option>

                                                <option value="4000000" @if(app('request')->input('min_price') == '4000000') selected @endif>
                                                    $4M
                                                </option>

                                                <option value="5000000" @if(app('request')->input('min_price') == '5000000') selected @endif>
                                                    $5M
                                                </option>

                                                <option value="10000000" @if(app('request')->input('min_price') == '10000000') selected @endif>
                                                    $10M
                                                </option>

                                            </select></td>
                                        <td width="10%" align="center">-</td>
                                        <td width="15%">
                                            <select class="selectpicker" id="max_price" data-live-search="false" data-live-search-style="begins" title="Any" name="max_price">
                                                <option value="0" data-default="" selected="">Max Price</option>

                                                <option value="100000" @if(app('request')->input('max_price') == '100000') selected @endif>
                                                    $100K
                                                </option>

                                                <option value="125000" @if(app('request')->input('max_price') == '125000') selected @endif>
                                                    $125K
                                                </option>

                                                <option value="150000" @if(app('request')->input('max_price') == '150000') selected @endif>
                                                    $150K
                                                </option>

                                                <option value="175000" @if(app('request')->input('max_price') == '175000') selected @endif>
                                                    $175K
                                                </option>

                                                <option value="200000" @if(app('request')->input('max_price') == '200000') selected @endif>
                                                    $200K
                                                </option>

                                                <option value="225000" @if(app('request')->input('max_price') == '225000') selected @endif>
                                                    $225K
                                                </option>

                                                <option value="250000" @if(app('request')->input('max_price') == '250000') selected @endif>
                                                    $250K
                                                </option>

                                                <option value="275000" @if(app('request')->input('max_price') == '275000') selected @endif>
                                                    $275K
                                                </option>

                                                <option value="300000" @if(app('request')->input('max_price') == '300000') selected @endif>
                                                    $300K
                                                </option>

                                                <option value="325000" @if(app('request')->input('max_price') == '325000') selected @endif>
                                                    $325K
                                                </option>

                                                <option value="350000" @if(app('request')->input('max_price') == '350000') selected @endif>
                                                    $350K
                                                </option>

                                                <option value="375000" @if(app('request')->input('max_price') == '375000') selected @endif>
                                                    $375K
                                                </option>

                                                <option value="400000" @if(app('request')->input('max_price') == '400000') selected @endif>
                                                    $400K
                                                </option>

                                                <option value="450000" @if(app('request')->input('max_price') == '450000') selected @endif>
                                                    $450K
                                                </option>

                                                <option value="500000" @if(app('request')->input('max_price') == '500000') selected @endif>
                                                    $500K
                                                </option>

                                                <option value="550000" @if(app('request')->input('max_price') == '100000') selected @endif>
                                                    $550K
                                                </option>

                                                <option value="600000" @if(app('request')->input('max_price') == '600000') selected @endif>
                                                    $600K
                                                </option>

                                                <option value="650000" @if(app('request')->input('max_price') == '650000') selected @endif>
                                                    $650K
                                                </option>

                                                <option value="700000" @if(app('request')->input('max_price') == '700000') selected @endif>
                                                    $700K
                                                </option>

                                                <option value="800000" @if(app('request')->input('max_price') == '800000') selected @endif>
                                                    $800K
                                                </option>

                                                <option value="900000" @if(app('request')->input('max_price') == '900000') selected @endif>
                                                    $900K
                                                </option>

                                                <option value="1000000" @if(app('request')->input('max_price') == '1000000') selected @endif>
                                                    $1M
                                                </option>

                                                <option value="1250000" @if(app('request')->input('max_price') == '1250000') selected @endif>
                                                    $1.25M
                                                </option>

                                                <option value="1500000" @if(app('request')->input('max_price') == '1500000') selected @endif>
                                                    $1.5M
                                                </option>

                                                <option value="1750000" @if(app('request')->input('max_price') == '1750000') selected @endif>
                                                    $1.75M
                                                </option>

                                                <option value="2000000" @if(app('request')->input('max_price') == '2000000') selected @endif>
                                                    $2M
                                                </option>

                                                <option value="2250000" @if(app('request')->input('max_price') == '2250000') selected @endif>
                                                    $2.25M
                                                </option>

                                                <option value="2500000" @if(app('request')->input('max_price') == '2500000') selected @endif>
                                                    $2.5M
                                                </option>

                                                <option value="2750000" @if(app('request')->input('max_price') == '2750000') selected @endif>
                                                    $2.75M
                                                </option>

                                                <option value="3000000" @if(app('request')->input('max_price') == '3000000') selected @endif>
                                                    $3M
                                                </option>

                                                <option value="4000000" @if(app('request')->input('max_price') == '4000000') selected @endif>
                                                    $4M
                                                </option>

                                                <option value="5000000" @if(app('request')->input('max_price') == '5000000') selected @endif>
                                                    $5M
                                                </option>

                                                <option value="10000000" @if(app('request')->input('max_price') == '10000000') selected @endif>
                                                    $10M
                                                </option>

                                            </select></td>

                                        <td width="20%">&nbsp;</td>
                                        <td width="20%"><select class="selectpicker" id="min_beds" data-live-search="false" data-live-search-style="begins" title="Bed" name="min_beds">
                                                <option value="" data-default="">Bed</option>
                                                <option value="1" @if(app('request')->input('min_beds') == '1') selected @endif>1+</option>
                                                <option value="2" @if(app('request')->input('min_beds') == '2') selected @endif>2+</option>
                                                <option value="3" @if(app('request')->input('min_beds') == '3') selected @endif>3+</option>
                                                <option value="4" @if(app('request')->input('min_beds') == '4') selected @endif>4+</option>
                                                <option value="5" @if(app('request')->input('min_beds') == '5') selected @endif>5+</option>
                                                <option value="6" @if(app('request')->input('min_beds') == '6') selected @endif>6+</option>
                                                <option value="7" @if(app('request')->input('min_beds') == '7') selected @endif>7+</option>
                                            </select>
                                        </td>
                                        <td width="10%" align="center">&nbsp;</td>

                                        <td width="20%"><select class="selectpicker" id="min_baths" data-live-search="false" data-live-search-style="begins" title="Bath" name="min_baths">
                                                <option value="" data-default="">Bath</option>
                                                <option value="1" @if(app('request')->input('min_baths') == '1') selected @endif>1+</option>
                                                <option value="2" @if(app('request')->input('min_baths') == '2') selected @endif>2+</option>
                                                <option value="3" @if(app('request')->input('min_baths') == '3') selected @endif>3+</option>
                                                <option value="4" @if(app('request')->input('min_baths') == '4') selected @endif>4+</option>
                                                <option value="5" @if(app('request')->input('min_baths') == '5') selected @endif>5+</option>
                                            </select>
                                        </td>
                                    </tr>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <table cellpadding="5" cellspacing="5" width="100%">
                                    <tr>
                                        <td width="12%">&nbsp;</td>
                                        <td width="35%">
                                            <a id="more_search" style="cursor:pointer">
                                                <input class="btn btn-secondary" value="More Filter" style="width:137px;background-color:#ff0000" type="button">
                                            </a>
                                        </td>
                                        <td width="4%">&nbsp;</td>
                                        <td width="14%">&nbsp;</td>
                                        <td width="35%"><input class="btn btn-secondary" value="Search" type="submit" style="width:137px;"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" id="more_search_div" style="background-color:#fff;padding-top:20px;padding-bottom:20px;display:none;padding-left:0px;padding-right:0px;z-index:100;position:absolute;border-top:1px solid rgb(0, 66, 116)">
                            <div class="col-md-4 col-sm-6 col-xs-12" style="padding-left:0px;padding-right:0px;margin-bottom:10px;">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                                    <div class="form-group">
                                        <label for="property-title">City or Zip</label>
                                        <input class="form-control" id="autocomplete" name="city_zip" placeholder="City or Zip" value="{{ app('request')->input('city_zip') }}" onBlur="getSchoolDistCommunities()">
                                    </div>

                                    <div class="form-group">
                                        <label for="school_district">School District</label>
                                        <select class="selectpicker" id="school_district" data-live-search="false" data-live-search-style="begins" title="Any" name="school_district">
                                            <option value="">-- Select a school district --</option>
                                            @foreach($school_dist_Lists as $school_dist_List)
                                            <option value="{{ $school_dist_List->SCHOOLDISTRICT }}" @if(app('request')->input('school_district')==$school_dist_List->SCHOOLDISTRICT) selected @endif>{{ $school_dist_List->SCHOOLDISTRICT }}</option>
                                            @endforeach
                                        </select>
                                    </div>




                                    <div class="form-group">
                                        <label for="property_type">Property Type</label>
                                        <select class="selectpicker" id="property_type" data-live-search="false" data-live-search-style="begins" title="Any" name="property_type">
                                            <option value="Residential" @if(app('request')->input('property_type') == 'Residential') selected @endif>Residential</option>
                                        </select>
                                    </div>

                                    <div class="form-group" style="display: inline-block; width: 100%;">
                                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:0px;">
                                            <label for="min_garage">Garages</label>
                                            <select class="selectpicker" id="min_garage" data-live-search="false" data-live-search-style="begins" title="Any" name="min_garage">
                                                <option value="" data-default="">Any</option>
                                                <option value="1" @if(app('request')->input('min_garage') == '1') selected @endif>1+</option>
                                                <option value="2" @if(app('request')->input('min_garage') == '2') selected @endif>2+</option>
                                                <option value="3" @if(app('request')->input('min_garage') == '3') selected @endif>3+</option>
                                                <option value="4" @if(app('request')->input('min_garage') == '4') selected @endif>4+</option>
                                                <option value="5" @if(app('request')->input('min_garage') == '5') selected @endif>5+</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-right:0px;">
                                            <label for="min_built_year">Year Built</label>
                                            <select class="selectpicker" id="min_built_year" data-live-search="false" data-live-search-style="begins" title="Any" name="min_built_year">
                                                @for($i=date('Y'); $i>=1990;$i--)
                                                    <option value="<?php echo $i ?>" @if(app('request')->input('min_built_year') == $i) ?> selected @endif><?php echo $i ?></option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>



                                    <div class="form-group" style="display: inline-block; width: 100%;">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;"><div class="form-group" style="margin-bottom: 0px;"><label for="min_square_footage">Square Footage</label></div></div>
                                        <div class="col-md-5 col-sm-5 col-xs-5" style="padding-right:0px;padding-left:0px;">
                                            <select class="selectpicker" id="min_square_footage" data-live-search="false" data-live-search-style="begins" title="Any" name="minsq">
                                                <option value="500" @if(app('request')->input('minsq') =='500') selected @endif>500 sqft</option>
                                                <option value="1000" @if(app('request')->input('minsq') =='1000') selected @endif>1,000 sqft</option>
                                                <option value="1250" @if(app('request')->input('minsq') =='1250') selected @endif>1,250 sqft</option>
                                                <option value="1500" @if(app('request')->input('minsq') =='1500') selected @endif>1,500 sqft</option>
                                                <option value="1750" @if(app('request')->input('minsq') =='1750') selected @endif>1,750 sqft</option>
                                                <option value="2000" @if(app('request')->input('minsq') =='2000') selected @endif>2,000 sqft</option>
                                                <option value="2250" @if(app('request')->input('minsq') =='2250') selected @endif>2,250 sqft</option>
                                                <option value="2500" @if(app('request')->input('minsq') =='2500') selected @endif>2,500 sqft</option>
                                                <option value="2750" @if(app('request')->input('minsq') =='2750') selected @endif>2,750 sqft</option>
                                                <option value="3000" @if(app('request')->input('minsq') =='3000') selected @endif>3,000 sqft</option>
                                                <option value="3500" @if(app('request')->input('minsq') =='3500') selected @endif>3,500 sqft</option>
                                                <option value="4000" @if(app('request')->input('minsq') =='4000') selected @endif>4,000 sqft</option>
                                                <option value="5000" @if(app('request')->input('minsq') =='5000') selected @endif>5,000 sqft</option>
                                                <option value="7500" @if(app('request')->input('minsq') =='7500') selected @endif>7,500 sqft</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="text-align: center; padding-top: 10px;">
                                            <span style="color:#004274;font-weight:bold">&mdash;</span>
                                        </div>

                                        <div class="col-md-5 col-sm-5 col-xs-5" style="padding-left:0px;padding-right:0px;">
                                            <select class="selectpicker" id="max_square_footage" data-live-search="false" data-live-search-style="begins" title="Any" name="maxsq">
                                                <option value="500" @if(app('request')->input('maxsq') =='500') selected @endif>500 sqft</option>
                                                <option value="1000" @if(app('request')->input('maxsq') =='1000') selected @endif>1,000 sqft</option>
                                                <option value="1250" @if(app('request')->input('maxsq') =='1250') selected @endif>1,250 sqft</option>
                                                <option value="1500" @if(app('request')->input('maxsq') =='1500') selected @endif>1,500 sqft</option>
                                                <option value="1750" @if(app('request')->input('maxsq') =='1750') selected @endif>1,750 sqft</option>
                                                <option value="2000" @if(app('request')->input('maxsq') =='2000') selected @endif>2,000 sqft</option>
                                                <option value="2250" @if(app('request')->input('maxsq') =='2250') selected @endif>2,250 sqft</option>
                                                <option value="2500" @if(app('request')->input('maxsq') =='2500') selected @endif>2,500 sqft</option>
                                                <option value="2750" @if(app('request')->input('maxsq') =='2750') selected @endif>2,750 sqft</option>
                                                <option value="3000" @if(app('request')->input('maxsq') =='3000') selected @endif>3,000 sqft</option>
                                                <option value="3500" @if(app('request')->input('maxsq') =='3500') selected @endif>3,500 sqft</option>
                                                <option value="4000" @if(app('request')->input('maxsq') =='4000') selected @endif>4,000 sqft</option>
                                                <option value="5000" @if(app('request')->input('maxsq') =='5000') selected @endif>5,000 sqft</option>
                                                <option value="7500" @if(app('request')->input('maxsq') =='7500') selected @endif>7,500 sqft</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group" style="display: inline-block; width: 100%;">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;"><div class="form-group" style="margin-bottom: 0px;"><label for="min_square_footage">Lot Size</label></div></div>
                                        <div class="col-md-5 col-sm-5 col-xs-5" style="padding-right:0px;padding-left:0px;margin-bottom:15px;">
                                            <select class="selectpicker" id="minlot" data-live-search="false" data-live-search-style="begins" title="Any" name="minlot">
                                                <option value="1" @if(app('request')->input('minlot') =='1') selected @endif>1 Acre</option>
                                                <option value="2" @if(app('request')->input('minlot') =='2') selected @endif>2 Acres</option>
                                                <option value="3" @if(app('request')->input('minlot') =='3') selected @endif>3 Acres</option>
                                                <option value="4" @if(app('request')->input('minlot') =='4') selected @endif>4 Acres</option>
                                                <option value="5" @if(app('request')->input('minlot') =='5') selected @endif>5 Acres</option>
                                                <option value="6" @if(app('request')->input('minlot') =='6') selected @endif>6 Acres</option>
                                                <option value="7" @if(app('request')->input('minlot') =='7') selected @endif>7 Acres</option>
                                                <option value="8" @if(app('request')->input('minlot') =='8') selected @endif>8 Acres</option>
                                                <option value="9" @if(app('request')->input('minlot') =='9') selected @endif>9 Acres</option>
                                                <option value="10" @if(app('request')->input('minlot') =='10') selected @endif>10 Acres</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="text-align: center; padding-top: 10px;margin-bottom:15px;">
                                            <span style="color:#004274;font-weight:bold">&mdash;</span>
                                        </div>

                                        <div class="col-md-5 col-sm-5 col-xs-5" style="padding-right:0px;padding-left:0px;margin-bottom:15px;">
                                            <select class="selectpicker" id="maxlot" data-live-search="false" data-live-search-style="begins" title="Any" name="maxlot">
                                                <option value="1" @if(app('request')->input('maxlot') =='1') selected @endif>1 Acre</option>
                                                <option value="2" @if(app('request')->input('maxlot') =='2') selected @endif>2 Acres</option>
                                                <option value="3" @if(app('request')->input('maxlot') =='3') selected @endif>3 Acres</option>
                                                <option value="4" @if(app('request')->input('maxlot') =='4') selected @endif>4 Acres</option>
                                                <option value="5" @if(app('request')->input('maxlot') =='5') selected @endif>5 Acres</option>
                                                <option value="6" @if(app('request')->input('maxlot') =='6') selected @endif>6 Acres</option>
                                                <option value="7" @if(app('request')->input('maxlot') =='7') selected @endif>7 Acres</option>
                                                <option value="8" @if(app('request')->input('maxlot') =='8') selected @endif>8 Acres</option>
                                                <option value="9" @if(app('request')->input('maxlot') =='9') selected @endif>9 Acres</option>
                                                <option value="10" @if(app('request')->input('maxlot') =='10') selected @endif>10 Acres</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12" style="padding-left:0px;padding-right:0px;margin-bottom:40px;">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Quick Move-In</span>
                                    <label class="switch">
                                        <input type="checkbox" name="quick_move_in" id="quick_move_in" value="1" @if(app('request')->input('quick_move_in') =='1') ?> checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">New Listing</span>
                                    <label class="switch">
                                        <input type="checkbox" name="new_listing" id="new_listing" value="1" @if(app('request')->input('new_listing') =='1') ?> checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6" >
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Open House</span>
                                    <label class="switch">
                                        <input type="checkbox" name="open_house" id="open_house" value="1" @if(app('request')->input('open_house') =='1') ?> checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Two Story</span>
                                    <label class="switch">
                                        <input type="checkbox" name="two_storied" id="two_storied" value="1" @if(app('request')->input('two_storied') =='1') ?> checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Price Reduced</span>
                                    <label class="switch">
                                        <input type="checkbox" name="price_reduced" id="price_reduced" value="1" @if(app('request')->input('price_reduced') =='1') ?> checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Lots Only</span>
                                    <label class="switch">
                                        <input type="checkbox" name="lots_only" id="lots_only" value="1" @if(app('request')->input('lots_only') =='1') ?> checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                            <?php  ?>

                                <div class="clearfix"></div>
                                <h2 style="padding-left: 16px; padding-top: 40px;">AMENITIES</h2>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Green Features</span>
                                    <label class="switch">
                                        <input type="checkbox" name="green_features" id="green_features" value="1" @if(app('request')->input('green_features') =='1') ?> checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Community Pool</span>
                                    <label class="switch">
                                        <input type="checkbox" name="community_pool" id="community_pool" value="1" @if(app('request')->input('community_pool') =='1') ?> checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Golf Course</span>
                                    <label class="switch">
                                        <input type="checkbox" name="golf_course" id="golf_course" value="1" @if(app('request')->input('golf_course') =='1') ?> checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Gated Community</span>
                                    <label class="switch">
                                        <input type="checkbox" name="gated_community" id="gated_community" value="1" @if(app('request')->input('gated_community') =='1') checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Nature Views</span>
                                    <label class="switch">
                                        <input type="checkbox" name="nature_views" id="nature_views" value="1" @if(app('request')->input('nature_views') =='1') checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Parks</span>
                                    <label class="switch">
                                        <input type="checkbox" name="parks" id="parks" value="1" @if(app('request')->input('parks') =='1') checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Pool</span>
                                    <label class="switch">
                                        <input type="checkbox" name="pool_check" id="pool_check" value="1" @if(app('request')->input('pool_check') =='1') checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Views</span>
                                    <label class="switch">
                                        <input type="checkbox" name="views" id="views" value="1" @if(app('request')->input('views') =='1') checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Waterfront</span>
                                    <label class="switch">
                                        <input type="checkbox" name="waterfront" id="waterfront" value="1" @if(app('request')->input('waterfront') =='1') checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span style="display: inline-block; margin-top: 6px;font-size:14px;">Club House</span>
                                    <label class="switch">
                                        <input type="checkbox" name="club_house" id="club_house" value="1" @if(app('request')->input('club_house') =='1') checked @endif>
                                        <div class="slider round"></div>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12" style="padding-left:0px;padding-right:0px;margin-bottom:40px;">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                                    <div class="form-group">
                                        <label for="builder_name">Builder Name</label>
                                        <select class="selectpicker" id="builder_name" data-live-search="false" data-live-search-style="begins" title="Any" name="builder_name">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="community_name">Community Name</label>
                                        <select class="selectpicker" id="community_name" data-live-search="false" data-live-search-style="begins" title="Any" name="community_name">
                                            <option value="">Any</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="community_status">Community Status</label>
                                        <select class="selectpicker" id="community_status" data-live-search="false" data-live-search-style="begins" title="Any" name="community_status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Pending">Pending</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="special_offers">Special Offers</label>
                                        <select class="selectpicker" id="special_offers" data-live-search="false" data-live-search-style="begins" title="Any" name="special_offers">
                                            <option value="1st Offer">1st Offer</option>
                                            <option value="2nd Offer">2nd Offer</option>
                                            <option value="3rd Offer">3rd Offer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0px;padding-right:0px;margin-bottom:40px;">
                                <div class="col-md-1 col-sm-1 col-xs-1">
                                    &nbsp;
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:right">
                                    <a onClick="reset_filter()"><input class="btn btn-secondary resfil" value="Reset Filter" type="button" style="background-color:#559955"></a>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:center">
                                    <a id="closefil"><input class="btn btn-secondary closefil" value="Close Filter" type="button" style="background-color:#ff0000"></a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4" style="text-align:left">
                                    <input class="btn btn-secondary subfil" value="Search" type="submit">
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-1">
                                    &nbsp;
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </section>


        <section id="section-body" class="houzez-body-half">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12 no-padding" style="height:100%" id="mapview">
                        <div class="map-half fave-screen-fix">
                            <div id="houzez-gmap-main" class="fave-screen-fix">
                                <div id="map-canvas"></div>

                                <div class="map-next-prev-actions">


                                    <div id="houzez-gmap-prev2" class="map-btn" style="margin-right: 10px; min-width: 150px; color: rgb(0, 0, 0); background: rgb(245, 245, 245) none repeat scroll 0px 0px; font-weight: bold;box-shadow:1px 1px 1px #888">
                                    {{--<span style="display:block">
                                        <?php if($listing_array2['total == 0): ?>
                                            <p style="color: #ff0000;font-weight: bold">No item found! Please try with different criteria</p>
                                        <?php else: ?>
                                        <?php if(!empty($_GET['page)): ?>
                                                Showing <?php echo ((($_GET['page-1)*$limit)+1) .' - '. ((($_GET['page*$limit)<$listing_array2['total)?($_GET['page*$limit):$listing_array2['total) ?> of <?php echo $listing_array2['total ?>
                                        <?php else: ?>
                                        <?php if($listing_array2['total<=$limit): ?>
                                                    Showing <?php echo ((0*$limit)+1) .' - '. $listing_array2['total ?> of <?php echo $listing_array2['total ?>
                                        <?php else: ?>
                                                    Showing <?php echo ((0*$limit)+1) .' - '. $limit ?> of <?php echo $listing_array2['total ?>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </span>--}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 no-padding property_col" style="background-color: white;height:auto;left: auto;opacity: 1;position: absolute;right: 0;transition: none 0s ease 0s ;z-index: 4;">
                        <div class="module-half fave-screen-fix content"  style="overflow: auto;width:100%">
                            <div class="houzez-module">
                                <div class="list-tabs table-list full-width" style="padding-bottom:5px;">
                                    <?php if((app('request')->input('property_type') == 'Residential') && (app('request')->input('lots_only') != '1')):  ?>
                                        <div class="col-xs-12">
                                            <h2 class="tabs-title" style="line-height:30px;margin-bottom:10px;">Homes For Sale</h2>
                                            <div class="col-xs-12" style="padding-right:0px;padding-left:0px;" id="sortdiv">
                                                <div class="col-xs-3" style="padding-left:0px;padding-right: 0px;">
                                                    <p style="margin:10px 0 20px 0">Sort By:</p>
                                                </div>
                                                {{--<div class="col-xs-9">
                                                    <select class="selectpicker" id="sort_type" data-live-search="false" data-live-search-style="begins" title="Any" name="sort_type">
                                                        <option value="">Any</option>
                                                        <option value="price_high_low" <?php if($_REQUEST['sort_type == 'price_high_low'): ?> selected<?php endif; ?>>Price (High to Low)</option>
                                                        <option value="price_low_high" <?php if($_REQUEST['sort_type == 'price_low_high'): ?> selected<?php endif; ?>>Price (Low to High)</option>
                                                        <option value="bed_high_low" <?php if($_REQUEST['sort_type == 'bed_high_low'): ?> selected<?php endif; ?>>Bed (High to Low)</option>
                                                        <option value="bed_low_high" <?php if($_REQUEST['sort_type == 'bed_low_high'): ?> selected<?php endif; ?>>Bed (Low to High)</option>
                                                        <option value="year_high_low" <?php if($_REQUEST['sort_type == 'year_high_low'): ?> selected<?php endif; ?>>Year (High to Low)</option>
                                                        <option value="year_low_high" <?php if($_REQUEST['sort_type == 'year_low_high'): ?> selected<?php endif; ?>>Year (Low to High)</option>
                                                        <option value="sqft_high_low" <?php if($_REQUEST['sort_type == 'sqft_high_low'): ?> selected<?php endif; ?>>Sq Ft (High to Low)</option>
                                                        <option value="sqft_low_high" <?php if($_REQUEST['sort_type == 'sqft_low_high'): ?> selected<?php endif; ?>>Sq Ft (Low to High)</option>
                                                    </select>
                                                </div>--}}
                                            </div>

                                            <div class="pagination-main">
                                                Pagination
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="property-listing list-view">
                                    <div class="row" id="markers_info">
                                        @if(!empty($propLists))
                                            @foreach($propLists as $propList)
                                                <div class="item-wrap">
                                                    <div class="property-item-grid">
                                                        <figure class="item-thumb">
                                                            <a href="{{ url('/') }}/property_details/{{ $propList->permalink }}/residential/" class="hover-effect">
                                                                @if($propList->PHOTOCOUNT>=1)
                                                                    <img src="{{ $propList->photo1_url }}" alt="" />
                                                                @else
                                                                    <img src="{{ asset('images/greenhome.jpg') }}" alt="" />
                                                                @endif
                                                            </a>
                                                            <div class="label-wrap label-left">
                                                                <!--<span class="label label-success">Featured</span>
                                                                <span class="label label-danger">Open House</span>-->
                                                            </div>
                                                            <div class="price">
                                                                <span class="item-price">${{ number_format($propList->LISTPRICE) }}</span>
                                                                <span class="item-sub-price">
                                                            	@if($propList->LISTPRICE < $propList->LISTPRICEORIG)
                                                                        {{ strstr( number_format(($propList->LISTPRICEORIG - $propList->LISTPRICE)),'.',true) }}&nbsp;&nbsp;<img src="{{ asset('images/downarrow.png') }}" style="width:15px;height:15px;">
                                                                @endif
                                                            </span>
                                                            </div>
                                                            <ul class="actions">
                                                                <li>
                                                                    @if(empty($_SESSION['front_user']))
                                                                    <a href="#" data-toggle="modal" data-target="#pop-login" style="color:#fff">
                                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                        <i class="fa fa-heart"></i>
                                                                    </span>
                                                                    </a>
                                                                    @else
                                                                    @if(!empty($_SESSION['front_user']['saved_lists']))
                                                                    @if(in_array($propList->MLSNUM,$_SESSION['front_user']['saved_lists']))
                                                                        <a style="color:#fff" id="add_remove_fav_{{ $propList->MLSNUM }}" onClick="add_remove_fav('{{ $_SESSION['front_user']['id'] }}','{{ $propList->MLSNUM }}','{{ $propList->PROPTYPE }}')">
                                                                        <span id="sel" title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                            <i class="fa fa-heart"></i>
                                                                        </span>
                                                                    </a>
                                                                    @else
                                                                        <a style="color:#fff" id="add_remove_fav_{{ $propList->MLSNUM }}" onClick="add_remove_fav('{{ $_SESSION['front_user']['id'] }}','{{ $propList->MLSNUM }}','{{ $propList->PROPTYPE }}')">
                                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                            <i class="fa fa-heart"></i>
                                                                        </span>
                                                                    </a>
                                                                    @endif
                                                                    @else
                                                                        <a style="color:#fff" id="add_remove_fav_{{ $propList->MLSNUM }}" onClick="add_remove_fav('{{ $_SESSION['front_user']['id'] }}','{{ $propList->MLSNUM }}','{{ $propList->PROPTYPE }}')">
                                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                            <i class="fa fa-heart"></i>
                                                                        </span>
                                                                    </a>
                                                                    <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </li>
                                                                <li>
                                                                <span data-toggle="tooltip" data-placement="top" title="Photos ({{ $propList->PHOTOCOUNT }})" style="width:48px">
                                                                    {{ $propList->PHOTOCOUNT }} &nbsp;<i class="fa fa-camera"></i>
                                                                </span>
                                                                </li>
                                                            </ul>
                                                            <div class="item-caption">
                                                                <h4 class="item-caption-title">
                                                                    {{ ($propList->STREETNUM?$propList->STREETNUM:'').($propList->STREETDIR?' '.$propList->STREETDIR:'').($propList->STREETNAME?' '.$propList->STREETNAME:'').($propList->STREETTYPE?' '.$propList->STREETTYPE:'').($propList->UNITNUMBER?' #'.$propList->UNITNUMBER:'') }}<br/>{{ $propList->CITY.' '.$propList->STATE.' '.$propList->ZIPCODE }}
                                                                </h4>
                                                                @if(app('request')->input('lots_only') != '1')
                                                                    <ul class="item-caption-list">
                                                                        @php
                                                                            $sim_fin_bath_room = '';
                                                                            $sim_totalbaths = '';
                                                                        @endphp
                                                                        @if(!empty($propList->BATHSFULL))
                                                                            @php $sim_fin_bath_room .= $propList->BATHSFULL; @endphp
                                                                        @endif
                                                                        @if(!empty($propList->BATHSHALF))
                                                                            @php $sim_fin_bath_room .= '/'.$propList->BATHSHALF; @endphp
                                                                        @endif


                                                                        @if(!empty($propList->BATHSTOTAL))
                                                                            @php $sim_totalbaths = $propList->BATHSTOTAL; @endphp
                                                                        @else
                                                                            @php $sim_totalbaths = $sim_fin_bath_room; @endphp
                                                                        @endif


                                                                        <li>{{ $propList->BEDS }} bed</li>
                                                                        <li>{{ $sim_totalbaths }} bath</li>
                                                                        <li>{{ $propList->GARAGECAP }} garage</li>
                                                                        <li>{{ number_format($propList->SQFTTOTAL) }} sqft</li>
                                                                    </ul>
                                                                @else
                                                                    <ul class="item-caption-list">
                                                                        <li>{{ $propList->LOTSIZE }} Acre @if($propList->LOTSIZE>1) {{ 's' }} @endif</li>
                                                                    </ul>
                                                                @endif
                                                            </div>
                                                        </figure>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="pagination-main" style="margin-bottom:100px;">
                                        Pagination
                                    </div>
                                </div>
                            </div>
                            <!--end latest listing module-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--end section page body-->

        <input type="hidden" name="southwest_lat" id="southwest_lat" value="">
        <input type="hidden" name="southwest_lng" id="southwest_lng" value="">

        <input type="hidden" name="northeast_lat" id="northeast_lat" value="">
        <input type="hidden" name="northeast_lng" id="northeast_lng" value="">

        <input type="hidden" name="is_map_dragging" id="is_map_dragging" value="">

    </form>

    <div id="map_sor_filter" class="col-md-12 col-sm-12 col-xs-12 no-padding" style="bottom: 0;position: fixed;background-color: #EF6224;z-index: 100;height:36px;">
        <div id="list_map" class="col-xs-4" style="padding-top: 7px;text-align: center;border-right: 1px solid #fff;padding-bottom: 7px;">
            <a style="cursor:pointer;color: #fff;" onClick="showMapView()">Map</a>
        </div>
        <div class="col-xs-4" style="padding-top: 7px;text-align: center;border-right: 1px solid #fff;padding-bottom: 7px;">
            <a style="cursor:pointer;color: #fff;" onClick="showSortView()">Sort</a>
        </div>
        <div class="col-xs-4" style="padding-top: 7px;text-align: center;border-right: 1px solid #fff;padding-bottom: 7px;">
            <a style="cursor:pointer;color: #fff;" id="filter">Filter</a>
        </div>
    </div>
@endsection

@section('javascript')
    <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAFqAPWaxVQnJMkCBEHvlP1fIqevvgoN44&#038;libraries=geometry%2Cplaces%2Cdrawing&#038;ver=4.7.4'></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/infobox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/markerclusterer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.mCustomScrollbar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>


    <script type="text/javascript">

        function reset_filter() {
            jQuery("select#min_price").val('');
            jQuery('select#min_price').selectpicker('refresh');
            jQuery("select#max_price").val('');
            jQuery('select#max_price').selectpicker('refresh');

            jQuery("select#min_beds").val('');
            jQuery('select#min_beds').selectpicker('refresh');

            jQuery("select#min_baths").val('');
            jQuery('select#min_baths').selectpicker('refresh');

            jQuery('#new_homes').attr('checked', false);
            jQuery('#quick_move_in').attr('checked', false);

            jQuery("#city_zip_mls").val('');

            jQuery("select#city").val('');
            jQuery('select#city').selectpicker('refresh');

            jQuery("select#school_district").val('');
            jQuery('select#school_district').selectpicker('refresh');

            jQuery("select#property_type").val('');
            jQuery('select#property_type').selectpicker('refresh');

            jQuery("select#lot_size").val('');
            jQuery('select#lot_size').selectpicker('refresh');

            jQuery("select#min_garage").val('');
            jQuery('select#min_garage').selectpicker('refresh');

            jQuery("select#min_built_year").val('');
            jQuery('select#min_built_year').selectpicker('refresh');

            jQuery("select#min_square_footage").val('');
            jQuery('select#min_square_footage').selectpicker('refresh');

            jQuery("select#max_square_footage").val('');
            jQuery('select#max_square_footage').selectpicker('refresh');


            jQuery('#new_listing').attr('checked', false);
            jQuery('#open_house').attr('checked', false);

            jQuery('#two_storied').attr('checked', false);
            jQuery('#price_reduced').attr('checked', false);

            jQuery('#green_features').attr('checked', false);
            jQuery('#community_pool').attr('checked', false);

            jQuery('#golf_course').attr('checked', false);
            jQuery('#gated_community').attr('checked', false);

            jQuery('#nature_views').attr('checked', false);
            jQuery('#parks').attr('checked', false);

            jQuery('#pool_check').attr('checked', false);
            jQuery('#views').attr('checked', false);

            jQuery('#waterfront').attr('checked', false);
            jQuery('#club_house').attr('checked', false);

            jQuery("select#builder_name").val('');
            jQuery('select#builder_name').selectpicker('refresh');

            jQuery("select#community_name").val('');
            jQuery('select#community_name').selectpicker('refresh');

            jQuery("select#community_status").val('');
            jQuery('select#community_status').selectpicker('refresh');

            jQuery("select#special_offers").val('');
            jQuery('select#special_offers').selectpicker('refresh');
        }

        function showHideFilterView () {
            jQuery("#more_search_div").toggle("slide", {
                duration: 200,
                direction: 'up'
            });


            setTimeout( function(){
                if(jQuery("#more_search_div").css("display") == "block"){
                    if(jQuery( window ).width()>767) {
                        jQuery('html, body').css("overflow", "auto");
                    }
                    jQuery("#filter").text('Close Filter');
                }
                if(jQuery("#more_search_div").css("display") == "none"){
                    if(jQuery( window ).width()>767) {
                        jQuery('html, body').css("overflow", "hidden");
                    }
                    jQuery("#filter").text('Filter');
                }
            }  , 250 );
        }





        jQuery(document).ready(function() {
            //initialize();
            jQuery('#markers_info .item-wrap').hover(
                function () {
                    var index = jQuery('#markers_info .item-wrap').index(this);

                    if (that) {
                        that.setZIndex();
                    }
                    that = markers[index];

                    markers[index].setIcon(highlightedIcon());
                    markers[index].setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
                },
                // mouse out
                function () {
                    var index = jQuery('#markers_info .item-wrap').index(this);
                    markers[index].setIcon(normalIcon());
                }
            );
        });


        jQuery('#markers_info .item-wrap').hover(
            function () {
                var index = jQuery('#markers_info .item-wrap').index(this);

                if (that) {
                    that.setZIndex();
                }
                that = markers[index];

                markers[index].setIcon(highlightedIcon());
                markers[index].setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
            },
            // mouse out
            function () {
                var index = jQuery('#markers_info .item-wrap').index(this);
                markers[index].setIcon(normalIcon());
            }
        );
        @php $str = ''; @endphp
        @if(!empty($propLists))
		    @foreach($propLists as $propList)
			    @php
                    $tmp_address_map = ($propList->STREETNUM?$propList->STREETNUM:'').($propList->STREETDIRSUFFIX?' '.$propList->STREETDIRSUFFIX:'').($propList->STREETNAME?' '.addslashes($propList->STREETNAME):'').($propList->STREETDIR?' '.$propList->STREETDIR:'').($propList->STREETDIRSUFFIX?' '.$propList->STREETDIRSUFFIX:'').($propList->UNITNUMBER?' #'.$propList->UNITNUMBER:'').'<br/>'.$propList->CITY.' '.$propList->STATE.' '.$propList->ZIPCODE;

                    $sim_fin_bath_room = '';
                    $sim_totalbaths = '';
                    if(!empty($propList->BATHSFULL))
                        $sim_fin_bath_room .= $propList->BATHSFULL;
                    if(!empty($propList->BATHSHALF))
                        $sim_fin_bath_room .= '/'.$propList->BATHSHALF;


                    if(!empty($propList->BATHSTOTAL)):
                        $sim_totalbaths = $propList->BATHSTOTAL;
                    else:
                        $sim_totalbaths = $sim_fin_bath_room;
                    endif;
                    $tmp_img_url = "";
                    $acc = "";
                @endphp

            @if($propList->PHOTOCOUNT>0)
                $tmp_img_url = '{{ $propList->photo1_url }}';
            @else
                $tmp_img_url = "{{ asset('images/greenhome.jpg') }}";
            @endif

            @if($propList->LOTSIZE>1)
                $acc = 'Acres';
            @else
                $acc = 'Acre';
            @endif

            @php
                $str .= "{lat: ".$propList->LATITUDE.", lng: ".$propList->LONGITUDE.", price: '".\App\Helpers\AppHelper::kmprice($propList->LISTPRICE)."', image: '".(($propList->PHOTOCOUNT>0)?$propList->photo1_url:'images/greenhome.jpg')."', address: '".$tmp_address_map."', LOTSIZE: '".$propList->LOTSIZE.' '.$acc."',bed: '".$propList->BEDS."', bath: '".$sim_totalbaths."', garage: '".$propList->GARAGECAP."', sqft: '".number_format($propList->SQFTTOTAL)."', property_type: '".$propList->PROPTYPE."', permalink: '".addslashes($propList->permalink)."', mlsnum: '".$propList->MLSNUM."'},";


            @endphp
			@endforeach
                @php $str = substr($str, 0, -1) @endphp
			@endif;

        var markerData = [   // the order of these markers must be the same as the <div class="marker"></div> elements
            {!! $str !!}
        ];

        //alert(markerData);

        var map;
        var that;
        var markers = [];
        var infoWindow_arr;
        var prevIndex;
        var mapOptions = {
            zoom: 7,
            gestureHandling: 'greedy',
            @if(!empty($propLists[0]))
                center: new google.maps.LatLng({{ $propLists[0]->LATITUDE }},{{ $propLists[0]->LONGITUDE }}),
            @else
                center: new google.maps.LatLng(32.811118,-96.835957),
            @endif
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };


        function kFormatter(num) {
            if(Math.abs(num)>999999) {
                return Math.sign(num)*((Math.abs(num)/1000000).toFixed(1)) + 'M';
            }
            else {
                return Math . abs(num) > 999 ? Math . sign(num) * ((Math . abs(num) / 1000) . toFixed(1)) + 'k' : Math . sign(num) * Math . abs(num);
            }
        }

        function addInfoWindow(marker, message) {

            var infoWindow = new google.maps.InfoWindow({
                content: message
            });

            google.maps.event.addListener(marker, 'click', function () {
                if (infoWindow_arr) {
                    infoWindow_arr.close();
                }

                var index = jQuery('#markers_info .item-wrap').index(this);

                infoWindow.open(map, marker);

                if (that) {
                    that.setZIndex();
                    that.setIcon(normalIcon());
                    //prevIndex = that;
                }
                that = marker;
                marker.setZIndex(google.maps.Marker.MAX_ZINDEX + 1);

                marker.setIcon(highlightedIcon());

                infoWindow_arr = infoWindow;
            });

            google.maps.event.addListener(map, "click", function(event) {
                infoWindow.close();

                if (that) {
                    that.setZIndex();
                    that.setIcon(normalIcon());
                    //prevIndex = that;
                }
                that = marker;
            });






            google.maps.event.addListener(infoWindow, 'domready', function() {

                // Reference to the DIV that wraps the bottom of infowindow
                var iwOuter = $('.gm-style-iw');

                var iwBackground = iwOuter.prev();

                // Removes background shadow DIV
                iwBackground.children(':nth-child(2)').css({'display' : 'none'});

                // Removes white background DIV
                iwBackground.children(':nth-child(4)').css({'display' : 'none'});

                // Moves the infowindow 115px to the right.
                //iwOuter.parent().parent().css({left: '0px',top: '-55px','z-index': '-107'});

                // Moves the shadow of the arrow 76px to the left margin.
                iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'display: none !important;'});

                // Moves the arrow 76px to the left margin.
                iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'display: none !important;'});

                // Changes the desired tail shadow color.
                //iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});


                // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
                if($('.iw-content').height() < 140){
                    $('.iw-bottom-gradient').css({display: 'none'});
                }

                // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
                iwCloseBtn.mouseout(function(){
                    $(this).css({opacity: '1'});
                });
            });
        }


        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var bounds = new google.maps.LatLngBounds();

        if (markerData.length > 0) {
            for (var i = 0; i < markerData.length; i++) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(markerData[i].lat, markerData[i].lng),
                    title: markerData[i].title,
                    label: {
                        text: markerData[i].price,
                        fontSize: '10px',
                    },
                    map: map,
                    draggable: true,
                    icon: normalIcon()
                })

                markers[i] = marker;
                <?php if(app('request')->input('lots_only') != '1'): ?>
                addInfoWindow(marker, '<div class="item-wrap"><div class="property-item-grid"><figure class="item-thumb"><a href="{{ url('/') }}/property_details/' + markerData[i].permalink + '/' + markerData[i].property_type + '" class="hover-effect"><img src="' + markerData[i].image + '" width="290" style="width:290px;"></a><div class="price"><span class="item-price">' + markerData[i].price + '</span><span class="item-sub-price"></div><div class="item-caption"><h4 class="item-caption-title">' + markerData[i].address + '</h4><ul class="item-caption-list"><li>' + markerData[i].bed + ' bed</li><li>' + markerData[i].bath + ' bath</li><li>' + markerData[i].garage + ' garage</li><li>' + markerData[i].sqft + ' sqft</li></ul></div></figure></div></div>');
                <?php else: ?>
                addInfoWindow(marker, '<div class="item-wrap"><div class="property-item-grid"><figure class="item-thumb"><a href="{{ url('/') }}/property_details/' + markerData[i].permalink + '/' + markerData[i].property_type + '" class="hover-effect"><img src="' + markerData[i].image + '" width="290" style="width:290px;"></a><div class="price"><span class="item-price">' + markerData[i].price + '</span><span class="item-sub-price"></div><div class="item-caption"><h4 class="item-caption-title">' + markerData[i].address + '</h4><ul class="item-caption-list"><li>' + markerData[i].LOTSIZE + '</li></ul></div></figure></div></div>');
                <?php  endif; ?>

                if (jQuery("#is_map_dragging").val() != '1') {
                    //alert('map dragged');
                    bounds.extend(new google.maps.LatLng(markerData[i].lat, markerData[i].lng));
                    map.fitBounds(bounds);
                }
            }
        }

        map.addListener("dragend", (e) => {
            jQuery("#southwest_lat").val(map.getBounds().getSouthWest().lat());
            jQuery("#southwest_lng").val(map.getBounds().getSouthWest().lng());

            jQuery("#northeast_lat").val(map.getBounds().getNorthEast().lat());
            jQuery("#northeast_lng").val(map.getBounds().getNorthEast().lng());

            jQuery("#is_map_dragging").val('1');

            var formValues= jQuery("#searchform").serialize();

            jQuery.ajax({
                url: "{{ url('/') }}/ajax/search.php",
                type: "post",
                data: formValues,
                success: function(data) {
                    //$("#listview").mCustomScrollbar("destroy"); //Destroy
                    $("#listview").html('<div class="loading">Loading ...</div>');

                    function deleteMarkers() {
                        clearMarkers();
                        markers = [];
                    }

                    function setMapOnAll(map) {
                        for (let i = 0; i < markers.length; i++) {
                            markers[i].setMap(map);
                        }
                    }

                    // Removes the markers from the map, but keeps them in the array.
                    function clearMarkers() {
                        setMapOnAll(null);
                    }

                    deleteMarkers();

                    var res = data.split("#####");

                    jQuery("#listview").html(res[0]);
                    jQuery("#houzez-gmap-prev2").html(res[2]);
                    var obj = jQuery.parseJSON(res[1]);

                    var str = '';

                    if(obj.length>0) {
                        //var markerData = [];
                        for(var i=0; i<obj.length; i++) {
                            //alert(obj[0].STREETNUM);
                            //console.log(obj[i]);
                            var tmp_address_map = '';
                            if(obj[i].STREETNUM) {
                                tmp_address_map += obj[i].STREETNUM;
                            }
                            if(obj[i].STREETDIRSUFFIX) {
                                tmp_address_map += ' '+obj[i].STREETDIRSUFFIX;
                            }
                            if(obj[i].STREETNAME) {
                                tmp_address_map += ' '+obj[i].STREETNAME;
                            }
                            if(obj[i].STREETDIR) {
                                tmp_address_map += ' '+obj[i].STREETDIR;
                            }
                            if(obj[i].STREETDIRSUFFIX) {
                                tmp_address_map += ' '+obj[i].STREETDIRSUFFIX;
                            }
                            if(obj[i].UNITNUMBER) {
                                tmp_address_map += ' '+obj[i].UNITNUMBER;
                            }
                            if(obj[i].CITY) {
                                tmp_address_map += ' '+obj[i].CITY;
                            }
                            if(obj[i].STATE) {
                                tmp_address_map += ' '+obj[i].STATE;
                            }
                            if(obj[i].ZIPCODE) {
                                tmp_address_map += ' '+obj[i].ZIPCODE;
                            }


                            var sim_fin_bath_room = '';
                            var sim_totalbaths = '';
                            if(obj[i].BATHSFULL)
                                sim_fin_bath_room += obj[i].BATHSFULL;

                            if(obj[i].BATHSHALF)
                                sim_fin_bath_room += '/'+obj[i].BATHSHALF;


                            if(obj[i].BATHSTOTAL)
                                sim_totalbaths += obj[i].BATHSTOTAL;
                            else
                                sim_totalbaths += sim_fin_bath_room;

                            var tmp_img_url = '';
                            if(obj[i].MLSNUM.indexOf('B') !== -1) {
                                var img_obj = jQuery.parseJSON(obj[i].images);
                                if(img_obj.length>0) {
                                    tmp_img_url = "{{ url('/') }}/media/property/"+obj[i].id+'/'.img_obj[0];
                                }
                                else {
                                    tmp_img_url = "{{ asset('images/greenhome.jpg') }}";
                                }
                            }
                            else {
                                if(obj[i].images)
                                    tmp_img_url = obj[i].images;
                                else
                                    tmp_img_url = "{{ asset('images/greenhome.jpg') }}";
                            }

                            var acc = '';
                            if(obj[i].LOTSIZE>1)
                                acc = 'Acres';
                            else
                                acc = 'Acre';


                            str  += "{lat: "+obj[i].LATITUDE+", lng: "+obj[i].LONGITUDE+", price: '"+obj[i].LISTPRICE+"', image: '"+tmp_img_url+"', address: '"+tmp_address_map+"', LOTSIZE: '"+obj[i].LOTSIZE+"',bed: '"+obj[i].BEDS+"', bath: '"+sim_totalbaths+"', garage: '"+obj[i].GARAGECAP+"', sqft: '"+obj[i].SQFTTOTAL+"', property_type: '"+obj[i].PROPTYPE+"', permalink: '"+obj[i].permalink+"', mlsnum: '"+obj[i].MLSNUM+"'},";


                            markerData[i]['lat'] = obj[i].LATITUDE;
                            markerData[i]['lng'] = obj[i].LONGITUDE;
                            markerData[i]['price'] = obj[i].LISTPRICE;
                            markerData[i]['image'] = tmp_img_url;
                            markerData[i]['address'] = tmp_address_map;
                            markerData[i]['LOTSIZE'] = obj[i].LOTSIZE;
                            markerData[i]['bed'] = obj[i].BEDS;
                            markerData[i]['bath'] = sim_totalbaths;
                            markerData[i]['garage'] = obj[i].GARAGECAP;
                            markerData[i]['sqft'] = obj[i].SQFTTOTAL;
                            markerData[i]['property_type'] = obj[i].PROPTYPE;
                            markerData[i]['permalink'] = obj[i].permalink;
                            markerData[i]['mlsnum'] = obj[i].MLSNUM;
                        }
                    }
                    //alert(obj[0].id);

                    var bounds = new google.maps.LatLngBounds();
                    if(markerData.length >0) {
                        for (var i = 0; i < markerData.length; i++) {
                            //alert(markerData[i].price);
                            var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(markerData[i].lat, markerData[i].lng),
                                title: 'Rasel',
                                label: {
                                    text: kFormatter(markerData[i].price),
                                    fontSize: '10px',
                                },
                                map: map,
                                icon: normalIcon()
                            })

                            markers[i] = marker;
                            addInfoWindow(marker, '<div class="item-wrap"><div class="property-item-grid"><figure class="item-thumb"><a href="https://buildentory.com/property_details/' + markerData[i].permalink + '/' + markerData[i].property_type + '" class="hover-effect"><img src="' + markerData[i].image + '" width="290" style="width:290px;"></a><div class="price"><span class="item-price">' + kFormatter(markerData[i].price) + '</span><span class="item-sub-price"></div><div class="item-caption"><h4 class="item-caption-title">' + markerData[i].address + '</h4><ul class="item-caption-list"><li>' + markerData[i].bed + ' bed</li><li>' + markerData[i].bath + ' bath</li><li>' + markerData[i].garage + ' garage</li><li>' + markerData[i].sqft + ' sqft</li></ul></div></figure></div></div>');
                        }
                    }


                    jQuery('#markers_info .item-wrap').hover(
                        function () {
                            var index = jQuery('#markers_info .item-wrap').index(this);

                            if (that) {
                                that.setZIndex();
                            }
                            that = markers[index];

                            markers[index].setIcon(highlightedIcon());
                            markers[index].setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
                        },
                        // mouse out
                        function () {
                            var index = jQuery('#markers_info .item-wrap').index(this);
                            markers[index].setIcon(normalIcon());
                        }

                    );
                    jQuery(".selectpicker").selectpicker();

                },
                complete: function () {
                    //jQuery("#listview").height(($( window ).height()-130)+"px");
                    /*jQuery("#listview").mCustomScrollbar({
                        theme:"minimal",
                        scrollButtons:{
                            enable:true
                        }
                    });*/

                    jQuery("select#sort_type").change(function() {
                        jQuery("#searchform").submit();
                    });
                }
            });
        });










        // functions that return icons.  Make or find your own markers.
        function normalIcon() {
            return {
                url: 'http://buildentory.com/images/pin1.png',
                labelOrigin: new google.maps.Point(38, 10)
            };
        }
        function highlightedIcon() {
            return {
                url: 'http://buildentory.com/images/pin2.png',
                labelOrigin: new google.maps.Point(38, 10)
            };
        }

    </script>



    <script>
        function showSortView(){
            jQuery('html, body').animate({scrollTop: '0px'}, 300);


            jQuery("#sortdiv button").css('background-color','#FFE2E2');
            jQuery("#sortdiv button").css('border-color','#FF0000');

            for (var i = 3; i >= 1; i--) {

                jQuery("#sortdiv").fadeOut(500).fadeIn(500)

            }

        }
        function showListView(){
            jQuery("#mapview").css('display','none');
            jQuery("#listview").css('display','block');

            jQuery("#list_map").html('<a style="cursor:pointer;color: #fff;" onClick="showMapView()">Map</a>');

            jQuery("#map_sor_filter").html('<div id="list_map" class="col-xs-4" style="padding-top: 7px;text-align: center;border-right: 1px solid #fff;padding-bottom: 7px;"><a style="cursor:pointer;color: #fff;" onClick="showMapView()">Map</a></div><div class="col-xs-4" style="padding-top: 7px;text-align: center;border-right: 1px solid #fff;padding-bottom: 7px;"><a style="cursor:pointer;color: #fff;" onClick="showSortView()">Sort</a></div><div class="col-xs-4" style="padding-top: 7px;text-align: center;border-right: 1px solid #fff;padding-bottom: 7px;"><a style="cursor:pointer;color: #fff;" id="filter1">Filter</a></div>').promise().done(function(){

                jQuery("#filter1").click(function () {
                    jQuery("#more_search_div").toggle("slide", {
                        duration: 200,
                        direction: 'up'
                    });

                    setTimeout( function(){
                        if(jQuery("#more_search_div").css("display") == "block"){
                            if(jQuery( window ).width()>767) {
                                jQuery('html, body').css("overflow", "auto");
                            }
                            jQuery("#filter1").text('Close Filter');
                            jQuery("#more_search").html('<input class="btn btn-secondary" value="Close Filter" style="width:137px;background-color:#ff0000" type="button">');
                        }
                        if(jQuery("#more_search_div").css("display") == "none"){
                            if(jQuery( window ).width()>767) {
                                jQuery('html, body').css("overflow", "hidden");
                            }
                            jQuery("#filter1").text('Filter');
                            jQuery("#more_search").html('<input class="btn btn-secondary" value="More Filter" style="width:137px;background-color:#ff0000" type="button">');
                        }
                    }  , 250 );
                });
            });
        }

        function showMapView(){
            jQuery("#listview").css('display','none');
            jQuery("#mapview").css('display','block');
            jQuery("#list_map").html('<a style="cursor:pointer;color: #fff;" onClick="showListView()">List</a>');

            jQuery("#map_sor_filter").html('<div id="list_map" class="col-xs-6" style="padding-top: 7px;text-align: center;border-right: 1px solid #fff;padding-bottom: 7px;"><a style="cursor:pointer;color: #fff;" onClick="showListView()">List</a></div><div class="col-xs-6" style="padding-top: 7px;text-align: center;border-right: 1px solid #fff;padding-bottom: 7px;"><a style="cursor:pointer;color: #fff;" id="filter2">Filter</a></div>').promise().done(function(){
                //your callback logic / code here

                jQuery("#filter2").click(function () {
                    jQuery("#more_search_div").toggle("slide", {
                        duration: 200,
                        direction: 'up'
                    });

                    setTimeout( function(){
                        if(jQuery("#more_search_div").css("display") == "block"){
                            if(jQuery( window ).width()>767) {
                                jQuery('html, body').css("overflow", "auto");
                            }
                            jQuery("#filter2").text('Close Filter');
                            jQuery("#more_search").html('<input class="btn btn-secondary" value="Close Filter" style="width:137px;background-color:#ff0000" type="button">');
                        }
                        if(jQuery("#more_search_div").css("display") == "none"){
                            if(jQuery( window ).width()>767) {
                                jQuery('html, body').css("overflow", "hidden");
                            }
                            jQuery("#filter2").text('Filter');
                            jQuery("#more_search").html('<input class="btn btn-secondary" value="More Filter" style="width:137px;background-color:#ff0000" type="button">');
                        }
                    }  , 250 );
                });

            });


        }
        jQuery(document).ready(function() {

            var citystr = '';
            var availableTags = [];

            @foreach($cityLists as $cityList)
                availableTags.push("{{ $cityList->CITY }}, TX");
            @endforeach

            jQuery( "#autocomplete" ).autocomplete({
                source: availableTags
            });


            jQuery("select#sort_type").change(function() {
                jQuery("#searchform").submit();
            });


            /*jQuery("#listview2").mCustomScrollbar({
                theme:"minimal",
                scrollButtons:{
                    enable:true
                }
            });*/



            jQuery("#more_search").click(function () {
                jQuery("#more_search_div").toggle("slide", {
                    duration: 200,
                    direction: 'up'
                });


                setTimeout( function(){
                    if(jQuery("#more_search_div").css("display") == "block"){
                        if(jQuery( window ).width()>767) {
                            jQuery('html, body').css("overflow", "auto");
                        }
                        jQuery("#more_search").html('<input class="btn btn-secondary" value="Close Filter" style="width:137px;background-color:#ff0000" type="button">');
                        if(jQuery('#filter').length) {
                            jQuery("#filter").text('Close Filter');
                        }
                        if(jQuery('#filter1').length) {
                            jQuery("#filter1").text('Close Filter');
                        }
                        if(jQuery('#filter2').length) {
                            jQuery("#filter2").text('Close Filter');
                        }
                    }
                    if(jQuery("#more_search_div").css("display") == "none"){
                        if(jQuery( window ).width()>767) {
                            jQuery('html, body').css("overflow", "hidden");
                        }
                        jQuery("#more_search").html('<input class="btn btn-secondary" value="More Filter" style="width:137px;background-color:#ff0000" type="button">');
                        if(jQuery('#filter').length) {
                            jQuery("#filter").text('Filter');
                        }
                        if(jQuery('#filter1').length) {
                            jQuery("#filter1").text('Filter');
                        }
                        if(jQuery('#filter2').length) {
                            jQuery("#filter2").text('Filter');
                        }
                    }
                }  , 250 );


            });

            jQuery("#closefil").click(function () {
                jQuery("#more_search_div").toggle("slide", {
                    duration: 200,
                    direction: 'up'
                });
            });

            jQuery("#filter").click(function () {
                jQuery("#more_search_div").toggle("slide", {
                    duration: 200,
                    direction: 'up'
                });


                setTimeout( function(){
                    if(jQuery("#more_search_div").css("display") == "block"){
                        if(jQuery( window ).width()>767) {
                            jQuery('html, body').css("overflow", "auto");
                        }
                        jQuery("#filter").text('Close Filter');
                        jQuery("#more_search").html('<input class="btn btn-secondary" value="Close Filter" style="width:137px;background-color:#ff0000" type="button">');
                    }
                    if(jQuery("#more_search_div").css("display") == "none"){
                        if(jQuery( window ).width()>767) {
                            jQuery('html, body').css("overflow", "hidden");
                        }
                        jQuery("#filter").text('Filter');
                        jQuery("#more_search").html('<input class="btn btn-secondary" value="More Filter" style="width:137px;background-color:#ff0000" type="button">');
                    }
                }  , 250 );


            });

            jQuery("#filter1").click(function () {
                jQuery("#more_search_div").toggle("slide", {
                    duration: 200,
                    direction: 'up'
                });


                setTimeout( function(){
                    if(jQuery("#more_search_div").css("display") == "block"){
                        if(jQuery( window ).width()>767) {
                            jQuery('html, body').css("overflow", "auto");
                        }
                        jQuery("#filter1").text('Close Filter');
                    }
                    if(jQuery("#more_search_div").css("display") == "none"){
                        if(jQuery( window ).width()>767) {
                            jQuery('html, body').css("overflow", "hidden");
                        }
                        jQuery("#filter1").text('Filter');
                    }
                }  , 250 );
            });


            jQuery( "#new_homes" ).checkboxradio({
                icon: false
            });

            jQuery( "#quick_move_in" ).checkboxradio({
                icon: false
            });

            jQuery( "#new_listing" ).checkboxradio({
                icon: false
            });

            jQuery( "#open_house" ).checkboxradio({
                icon: false
            });

            jQuery( "#two_storied" ).checkboxradio({
                icon: false
            });

            jQuery( "#price_reduced" ).checkboxradio({
                icon: false
            });

            jQuery( "#pool" ).checkboxradio({
                icon: false
            });
            jQuery( "#green_features" ).checkboxradio({
                icon: false
            });
            jQuery( "#community_pool" ).checkboxradio({
                icon: false
            });
            jQuery( "#golf_course" ).checkboxradio({
                icon: false
            });
            jQuery( "#gated_community" ).checkboxradio({
                icon: false
            });
            jQuery( "#nature_views" ).checkboxradio({
                icon: false
            });
            jQuery( "#parks" ).checkboxradio({
                icon: false
            });
            jQuery( "#pool_check" ).checkboxradio({
                icon: false
            });
            jQuery( "#views" ).checkboxradio({
                icon: false
            });
            jQuery( "#waterfront" ).checkboxradio({
                icon: false
            });
            jQuery( "#club_house" ).checkboxradio({
                icon: false
            });
        });
    </script>
@endsection
