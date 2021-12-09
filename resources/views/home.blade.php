@extends('layouts.app')

@section('content')
<div class="header-media">
    <div class="banner-parallax">
        <div class="banner-bg-wrap">
            <div class="banner-inner" style="background-image: url('{{ asset('images/dreamhome.jpg') }}')"></div>
        </div>
        <div class="banner-caption">

            <h1>Find Your Dream Home</h1>
            <div style="margin-bottom: 10px">&nbsp;</div>
            <form method="GET"  action="{{ url('/') }}/search">
                {{--<div class="field-holder select-dropdown property-type checkbox">
                    <ul>
                        <li>
                            <input checked="checked" id="search_form_property_type1" name="property_type" value="Residential" type="radio">                    <label for="search_form_property_type1">For Sale</label>
                        </li>
                        <li>
                            <input id="search_form_property_type2" name="property_type" value="communities" type="radio">                            <label for="search_form_property_type2">Communities</label>
                        </li>
                    </ul>
                </div>--}}
                <div class="banner-search-main">
                    <div class="search-default-fields ">

                        <div class="form-group" style="margin-bottom:0px;">
                            <div class="search field-group">
                                <input id="autocomplete" name="city_zip" placeholder="Type a city or zip code..." value="Dallas, TX">
                            </div>
                            <div class="search-btn">
                                <button class="btn btn-secondary"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

</div>
<section id="section-body">

    <!--start carousel module-->
    <div class="houzez-module-main">
        <div class="houzez-module carousel-module">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="module-title-nav clearfix">
                            <div>
                                <h2>Latest for Sale</h2>
                            </div>
                            <div class="module-nav">
                                <button class="btn btn-sm btn-crl-pprt-1-prev">Prev</button>
                                <button class="btn btn-sm btn-crl-pprt-1-next">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row grid-row">
                            <div class="carousel properties-carousel-grid-1 slide-animated">
                                <div class="item">
                                    <div class="item-wrap">
                                        <div class="property-item item-grid">
                                            <div class="figure-block">
                                                <figure class="item-thumb">

                                                    <span class="label-featured label label-success">Featured</span>
                                                    <div class="price hide-on-list">
                                                        <h3>$350,000</h3>
                                                    </div>
                                                    <a href="#" class="hover-effect">
                                                        <img src="{{ asset('images/home1.jpg') }}" alt="thumb">
                                                    </a>
                                                    <ul class="actions">
                                                        <li>
                                                            <span data-toggle="tooltip" data-placement="top" title="Favorite">
                                                                <i class="fa fa-heart-o"></i>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                <i class="fa fa-camera"></i>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </figure>
                                            </div>
                                            <div class="item-body">
                                                <div class="body-left">
                                                    <div class="info-row">
                                                        <h2 class="property-title"><a href="#">7601 East Treasure Dr. Miami Beach, FL 33141</a></h2>
                                                    </div>
                                                    <div class="table-list full-width info-row">
                                                        <div class="cell">
                                                            <div class="info-row amenities">
                                                                <p>
                                                                    <span>Beds: 3</span>
                                                                    <span>Baths: 2</span>
                                                                    <span>Sqft: 1,965</span>
                                                                </p>
                                                                <p>Single Family Home</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-foot date hide-on-list">
                                            <div class="item-foot-left">
                                                <p><i class="fa fa-user"></i> <a href="#">Elite Ocean View Realty LLC</a></p>
                                            </div>
                                            <div class="item-foot-right">
                                                <p><i class="fa fa-calendar"></i> 12 Days ago </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item-wrap">
                                        <div class="property-item item-grid">
                                            <div class="figure-block">
                                                <figure class="item-thumb">

                                                    <span class="label-featured label label-success">Featured</span>
                                                    <div class="price hide-on-list">
                                                        <h3>$350,000</h3>
                                                    </div>
                                                    <a href="#" class="hover-effect">
                                                        <img src="{{ asset('images/home2.jpg') }}" alt="thumb">
                                                    </a>
                                                    <ul class="actions">
                                                        <li>
                                                            <span data-toggle="tooltip" data-placement="top" title="Favorite">
                                                                <i class="fa fa-heart-o"></i>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                <i class="fa fa-camera"></i>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </figure>
                                            </div>
                                            <div class="item-body">
                                                <div class="body-left">
                                                    <div class="info-row">
                                                        <h2 class="property-title"><a href="#">7601 East Treasure Dr. Miami Beach, FL 33141</a></h2>
                                                    </div>
                                                    <div class="table-list full-width info-row">
                                                        <div class="cell">
                                                            <div class="info-row amenities">
                                                                <p>
                                                                    <span>Beds: 3</span>
                                                                    <span>Baths: 2</span>
                                                                    <span>Sqft: 1,965</span>
                                                                </p>
                                                                <p>Single Family Home</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-foot date hide-on-list">
                                            <div class="item-foot-left">
                                                <p><i class="fa fa-user"></i> <a href="#">Elite Ocean View Realty LLC</a></p>
                                            </div>
                                            <div class="item-foot-right">
                                                <p><i class="fa fa-calendar"></i> 12 Days ago </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item-wrap">
                                        <div class="property-item item-grid">
                                            <div class="figure-block">
                                                <figure class="item-thumb">

                                                    <span class="label-featured label label-success">Featured</span>
                                                    <div class="price hide-on-list">
                                                        <h3>$350,000</h3>
                                                    </div>
                                                    <a href="#" class="hover-effect">
                                                        <img src="{{ asset('images/home3.jpg') }}" alt="thumb">
                                                    </a>
                                                    <ul class="actions">
                                                        <li>
                                                                            <span data-toggle="tooltip" data-placement="top" title="Favorite">
                                                                                <i class="fa fa-heart-o"></i>
                                                                            </span>
                                                        </li>
                                                        <li>
                                                                            <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                                <i class="fa fa-camera"></i>
                                                                            </span>
                                                        </li>
                                                    </ul>
                                                </figure>
                                            </div>
                                            <div class="item-body">
                                                <div class="body-left">
                                                    <div class="info-row">
                                                        <h2 class="property-title"><a href="#">7601 East Treasure Dr. Miami Beach, FL 33141</a></h2>
                                                    </div>
                                                    <div class="table-list full-width info-row">
                                                        <div class="cell">
                                                            <div class="info-row amenities">
                                                                <p>
                                                                    <span>Beds: 3</span>
                                                                    <span>Baths: 2</span>
                                                                    <span>Sqft: 1,965</span>
                                                                </p>
                                                                <p>Single Family Home</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-foot date hide-on-list">
                                            <div class="item-foot-left">
                                                <p><i class="fa fa-user"></i> <a href="#">Elite Ocean View Realty LLC</a></p>
                                            </div>
                                            <div class="item-foot-right">
                                                <p><i class="fa fa-calendar"></i> 12 Days ago </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item-wrap">
                                        <div class="property-item item-grid">
                                            <div class="figure-block">
                                                <figure class="item-thumb">

                                                    <span class="label-featured label label-success">Featured</span>
                                                    <div class="price hide-on-list">
                                                        <h3>$350,000</h3>
                                                    </div>
                                                    <a href="#" class="hover-effect">
                                                        <img src="{{ asset('images/home4.jpg') }}" alt="thumb">
                                                    </a>
                                                    <ul class="actions">
                                                        <li>
                                                                            <span data-toggle="tooltip" data-placement="top" title="Favorite">
                                                                                <i class="fa fa-heart-o"></i>
                                                                            </span>
                                                        </li>
                                                        <li>
                                                                            <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                                <i class="fa fa-camera"></i>
                                                                            </span>
                                                        </li>
                                                    </ul>
                                                </figure>
                                            </div>
                                            <div class="item-body">
                                                <div class="body-left">
                                                    <div class="info-row">
                                                        <h2 class="property-title"><a href="#">7601 East Treasure Dr. Miami Beach, FL 33141</a></h2>
                                                    </div>
                                                    <div class="table-list full-width info-row">
                                                        <div class="cell">
                                                            <div class="info-row amenities">
                                                                <p>
                                                                    <span>Beds: 3</span>
                                                                    <span>Baths: 2</span>
                                                                    <span>Sqft: 1,965</span>
                                                                </p>
                                                                <p>Single Family Home</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-foot date hide-on-list">
                                            <div class="item-foot-left">
                                                <p><i class="fa fa-user"></i> <a href="#">Elite Ocean View Realty LLC</a></p>
                                            </div>
                                            <div class="item-foot-right">
                                                <p><i class="fa fa-calendar"></i> 12 Days ago </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item-wrap">
                                        <div class="property-item item-grid">
                                            <div class="figure-block">
                                                <figure class="item-thumb">

                                                    <span class="label-featured label label-success">Featured</span>
                                                    <div class="price hide-on-list">
                                                        <h3>$350,000</h3>
                                                    </div>
                                                    <a href="#" class="hover-effect">
                                                        <img src="{{ asset('images/home5.jpg') }}" alt="thumb">
                                                    </a>
                                                    <ul class="actions">
                                                        <li>
                                                                            <span data-toggle="tooltip" data-placement="top" title="Favorite">
                                                                                <i class="fa fa-heart-o"></i>
                                                                            </span>
                                                        </li>
                                                        <li>
                                                                            <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                                <i class="fa fa-camera"></i>
                                                                            </span>
                                                        </li>
                                                    </ul>
                                                </figure>
                                            </div>
                                            <div class="item-body">
                                                <div class="body-left">
                                                    <div class="info-row">
                                                        <h2 class="property-title"><a href="#">7601 East Treasure Dr. Miami Beach, FL 33141</a></h2>
                                                    </div>
                                                    <div class="table-list full-width info-row">
                                                        <div class="cell">
                                                            <div class="info-row amenities">
                                                                <p>
                                                                    <span>Beds: 3</span>
                                                                    <span>Baths: 2</span>
                                                                    <span>Sqft: 1,965</span>
                                                                </p>
                                                                <p>Single Family Home</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-foot date hide-on-list">
                                            <div class="item-foot-left">
                                                <p><i class="fa fa-user"></i> <a href="#">Elite Ocean View Realty LLC</a></p>
                                            </div>
                                            <div class="item-foot-right">
                                                <p><i class="fa fa-calendar"></i> 12 Days ago </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item-wrap">
                                        <div class="property-item item-grid">
                                            <div class="figure-block">
                                                <figure class="item-thumb">

                                                    <span class="label-featured label label-success">Featured</span>
                                                    <div class="price hide-on-list">
                                                        <h3>$350,000</h3>
                                                    </div>
                                                    <a href="#" class="hover-effect">
                                                        <img src="{{ asset('images/home6.jpg') }}" alt="thumb">
                                                    </a>
                                                    <ul class="actions">
                                                        <li>
                                                                            <span data-toggle="tooltip" data-placement="top" title="Favorite">
                                                                                <i class="fa fa-heart-o"></i>
                                                                            </span>
                                                        </li>
                                                        <li>
                                                                            <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                                <i class="fa fa-camera"></i>
                                                                            </span>
                                                        </li>
                                                    </ul>
                                                </figure>
                                            </div>
                                            <div class="item-body">
                                                <div class="body-left">
                                                    <div class="info-row">
                                                        <h2 class="property-title"><a href="#">7601 East Treasure Dr. Miami Beach, FL 33141</a></h2>
                                                    </div>
                                                    <div class="table-list full-width info-row">
                                                        <div class="cell">
                                                            <div class="info-row amenities">
                                                                <p>
                                                                    <span>Beds: 3</span>
                                                                    <span>Baths: 2</span>
                                                                    <span>Sqft: 1,965</span>
                                                                </p>
                                                                <p>Single Family Home</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-foot date hide-on-list">
                                            <div class="item-foot-left">
                                                <p><i class="fa fa-user"></i> <a href="#">Elite Ocean View Realty LLC</a></p>
                                            </div>
                                            <div class="item-foot-right">
                                                <p><i class="fa fa-calendar"></i> 12 Days ago </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end carousel module-->

    <!--start property item module-->
    <div class="houzez-module-main module-gray-bg">
        <div class="houzez-module module-title text-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Best Property Value</h2>
                        <h3 class="sub-heading">Create Your Real Estate Website or Marketplace</h3>
                    </div>
                </div>
            </div>
        </div>
        <div id="property-item-module" class="houzez-module property-item-module">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row grid-row">
                            <div class="col-sm-6">
                                <div class="item-wrap">
                                    <div class="property-item item-grid">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <span class="label-featured label label-success">Featured</span>
                                                <div class="price hide-on-list">
                                                    <h3>$350,000</h3>
                                                </div>
                                                <a href="#" class="hover-effect">
                                                    <img src="{{ asset('images/home7.jpg') }}" alt="thumb">
                                                </a>
                                                <ul class="actions">
                                                    <li>
                                                        <span data-toggle="tooltip" data-placement="top" title="Favorite">
                                                            <i class="fa fa-heart-o"></i>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                            <i class="fa fa-camera"></i>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </figure>
                                        </div>
                                        <div class="item-body">

                                            <div class="body-left">
                                                <div class="info-row">
                                                    <h2 class="property-title"><a href="#">7601 East Treasure Dr. Miami Beach, FL 33141</a></h2>
                                                </div>
                                                <div class="table-list full-width info-row">
                                                    <div class="cell">
                                                        <div class="info-row amenities">
                                                            <p>
                                                                <span>Beds: 3</span>
                                                                <span>Baths: 2</span>
                                                                <span>Sqft: 1,965</span>
                                                            </p>
                                                            <p>Single Family Home</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="item-foot date hide-on-list">
                                        <div class="item-foot-left">
                                            <p><i class="fa fa-user"></i> <a href="#">Elite Ocean View Realty LLC</a></p>
                                        </div>
                                        <div class="item-foot-right">
                                            <p><i class="fa fa-calendar"></i> 12 Days ago </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="item-wrap">
                                    <div class="property-item item-grid">
                                        <div class="figure-block">
                                            <figure class="item-thumb">

                                                <span class="label-featured label label-success">Featured</span>
                                                <div class="price hide-on-list">
                                                    <h3>$350,000</h3>
                                                </div>
                                                <a href="#" class="hover-effect">
                                                    <img src="{{ asset('images/home8.jpg') }}" alt="thumb">
                                                </a>
                                                <ul class="actions">
                                                    <li>
                                                        <span data-toggle="tooltip" data-placement="top" title="Favorite">
                                                            <i class="fa fa-heart-o"></i>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                            <i class="fa fa-camera"></i>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </figure>
                                        </div>
                                        <div class="item-body">

                                            <div class="body-left">
                                                <div class="info-row">
                                                    <h2 class="property-title"><a href="#">7601 East Treasure Dr. Miami Beach, FL 33141</a></h2>
                                                </div>
                                                <div class="table-list full-width info-row">
                                                    <div class="cell">
                                                        <div class="info-row amenities">
                                                            <p>
                                                                <span>Beds: 3</span>
                                                                <span>Baths: 2</span>
                                                                <span>Sqft: 1,965</span>
                                                            </p>
                                                            <p>Single Family Home</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="item-foot date hide-on-list">
                                        <div class="item-foot-left">
                                            <p><i class="fa fa-user"></i> <a href="#">Elite Ocean View Realty LLC</a></p>
                                        </div>
                                        <div class="item-foot-right">
                                            <p><i class="fa fa-calendar"></i> 12 Days ago </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end property item module-->

    <!--start agents module-->
    <div class="houzez-module module-title text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h2>Agents</h2>
                    {{--<h3 class="sub-heading">Here could be a nice sub title</h3>--}}
                </div>
            </div>
        </div>
    </div>
    <div id="agents-module" class="houzez-module agents-module">
        <div class="container">
            <div class="agents-blocks-main">
                <div class="row no-margin">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="agents-block">
                            <figure class="auther-thumb">
                                <img src="{{ asset('images/agent1.jpg') }}" alt="thumb" width="71" height="71" class="img-circle">
                            </figure>

                            <div class="block-body">
                                <p class="auther-info">
                                    <span>by <span class="blue">John Doe</span></span>
                                    <span>Founder & CEO, Company Name</span>
                                </p>
                                <p class="description">Lorem ipsum dolor sit cotetur
                                    adipiscing elit. Nam solltudin
                                    nulla vitae suscipit.
                                </p>
                                <a href="#" class="view">View profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="agents-block">
                            <figure class="auther-thumb">
                                <img src="{{ asset('images/agent2.jpg') }}" alt="thumb" width="71" height="71" class="img-circle">
                            </figure>

                            <div class="block-body">
                                <p class="auther-info">
                                    <span>by <span class="blue">John Doe</span></span>
                                    <span>Founder & CEO, Company Name</span>
                                </p>
                                <p class="description">Lorem ipsum dolor sit cotetur
                                    adipiscing elit. Nam solltudin
                                    nulla vitae suscipit.
                                </p>
                                <a href="#" class="view">View profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="agents-block">
                            <figure class="auther-thumb">
                                <img src="{{ asset('images/agent3.jpg') }}" alt="thumb" width="71" height="71" class="img-circle">
                            </figure>

                            <div class="block-body">
                                <p class="auther-info">
                                    <span>by <span class="blue">John Doe</span></span>
                                    <span>Founder & CEO, Company Name</span>
                                </p>
                                <p class="description">Lorem ipsum dolor sit cotetur
                                    adipiscing elit. Nam solltudin
                                    nulla vitae suscipit.
                                </p>
                                <a href="#" class="view">View profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="agents-block">
                            <figure class="auther-thumb">
                                <img src="{{ asset('images/agent4.jpg') }}" alt="thumb" width="71" height="71" class="img-circle">
                            </figure>

                            <div class="block-body">
                                <p class="auther-info">
                                    <span>by <span class="blue">John Doe</span></span>
                                    <span>Founder & CEO, Company Name</span>
                                </p>
                                <p class="description">Lorem ipsum dolor sit cotetur
                                    adipiscing elit. Nam solltudin
                                    nulla vitae suscipit.
                                </p>
                                <a href="#" class="view">View profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end agents module-->

</section>
@endsection
