<?php 
	require_once('includes/config.inc.php'); 
	include('includes/pager.class.php');
	
	function kmprice($value) {
		$finstr = '';
		if(strlen(trim($value))>6) {
			  $ab = '$'.number_format($value/1000000, 2, '.', '');
			 if(strstr($ab,'.')==00) {
				$ac = explode('.',$ab);
				$finstr .= $ac[0].'M';	
			}
			else 
				$finstr .= $ab.'M';
		}
		else if(strlen(trim($value))<=4) {
			$finstr .= '$'.trim($value);
		}
		else {
			 $finstr .= '$'.round(trim($value)/1000).'K';
		}
		return $finstr;
	}
	
	//print_r($_REQUEST);
	$query_string = '';
	$sel_table = '';
	$proptype = '';
	if($_REQUEST['prop_type'] == 'for_sale') {
		$sel_table = 'res_properties';
		$proptype = 'For Sale';
		$query_string .= '&prop_type=for_sale';
	}
	else if($_REQUEST['prop_type'] == 'for_rent') {
		$sel_table = 'lse_properties';
		$proptype = 'For Rent';
		$query_string .= '&prop_type=for_rent';
	}
	else {
		$_REQUEST['prop_type'] == 'for_sale';
		$sel_table = 'res_properties';
		$proptype = 'For Sale';
		$query_string .= '&prop_type=for_sale';
	}
	
	$query_str = ' 1=1 ';
	if(!empty($_REQUEST['city_zip_mls'])) {
		if(is_numeric(trim($_REQUEST['city_zip_mls']))) {
			if(strlen(trim($_REQUEST['city_zip_mls'])) == 8) {
				$query_str .= " and MLSNUM='".trim($_REQUEST['city_zip_mls'])."'";	
			}
			else {
				$query_str .= " and ZIPCODE='".trim($_REQUEST['city_zip_mls'])."'";	
			}
		}
		else {
			$query_str .= " and CITY='".trim($_REQUEST['city_zip_mls'])."'";	
		}
		$query_string .= '&city_zip_mls='.$_REQUEST['city_zip_mls'];
	}
	
	if(!empty($_REQUEST['address_mls_zip'])) {
		if(!strstr($_GET['address_mls_zip'],' ')) {	
			$query_str .= " and ZIPCODE like '%".$_GET['address_mls_zip']."%'";
		}
		else {
			if(strstr($_GET['address_mls_zip'],' ')) {
				$mlsarr = explode(' ',$_GET['address_mls_zip']);
				if(!empty($mlsarr[0]))
					$query_str .= " and STREETNUM ='".$mlsarr[0]."'";	
				
				if(!empty($mlsarr[1]))
					$query_str .= " and STREETNAME like'%".$mlsarr[1]."%'";		
			}	
		}	
		$query_string .= '&address_mls_zip='.$_REQUEST['address_mls_zip'];
	}
	
	if(!empty($_REQUEST['city'])) {
		$query_str .= " and CITY ='".$_REQUEST['city']."'";	
		$query_string .= '&city='.$_REQUEST['city'];	
	}
	
	if(!empty($_REQUEST['min_built_year'])) {
		$query_str .= " and YEARBUILT >='".$_REQUEST['min_built_year']."'";	
		$query_string .= '&min_built_year='.$_REQUEST['min_built_year'];	
	}
	
	
	if(!empty($_REQUEST['min_sqft'])) {
		$query_str .= " and SQFTTOTAL >='".$_REQUEST['min_sqft']."'";	
		$query_string .= '&min_sqft='.$_REQUEST['min_sqft'];	
	}
	if(!empty($_REQUEST['max_sqft'])) {
		$query_str .= " and SQFTTOTAL <='".$_REQUEST['max_sqft']."'";	
		$query_string .= '&min_sqft='.$_REQUEST['min_sqft'];	
	}
	
	if(!empty($_REQUEST['min_beds'])) {
		$query_str .= " and BEDS >='".$_REQUEST['min_beds']."'";	
		$query_string .= '&min_beds='.$_REQUEST['min_beds'];	
	}
	if(!empty($_REQUEST['min_baths'])) {
		$query_str .= " and BATHSFULL >='".$_REQUEST['min_baths']."'";	
		$query_string .= '&min_baths='.$_REQUEST['min_baths'];	
	}
	if(!empty($_REQUEST['min_garage'])) {
		$query_str .= " and GARAGECAP >='".$_REQUEST['min_garage']."'";		
		$query_string .= '&min_garage='.$_REQUEST['min_garage'];
	}
	
	
	if(!empty($_REQUEST['new_listing'])) {
		$query_str .= " and created  <> '' and created>'".date('Y-m-d H:i:s',(time()-(7*86400)))."'";
		$query_string .= '&new_listing='.$_REQUEST['new_listing'];
	}
	
	if(!empty($_REQUEST['price_reduced'])) {
		$query_str .= " and LISTPRICE < LISTPRICEORIG ";
		$query_string .= '&price_reduced='.$_REQUEST['price_reduced'];
	}
	
	if(!empty($_REQUEST['open_house'])) {
		$query_str .= " and OPENHOUSEDATE >= '".date('Y-m-d')."'";
		$query_string .= '&open_house='.$_REQUEST['open_house'];
	}
	
	if(!empty($_REQUEST['pool'])) {
		$query_str .= " and POOLYN <>'' ";
		$query_string .= '&pool='.$_REQUEST['pool'];
	}
	
	if(!empty($_REQUEST['two_storied'])) {
		$query_str .=  " and STORIES >= 2 ";
		$query_string .= '&two_storied='.$_REQUEST['two_storied'];
	}
	
	
	if(!empty($_REQUEST['min_price']) && empty($_REQUEST['max_price']))
	{
		$query_str .= " and ListPrice >=".$_REQUEST['min_price'];
		$query_string .= '&min_price='.$_REQUEST['min_price'];
	}
	if(empty($_REQUEST['min_price']) && !empty($_REQUEST['max_price']))
	{
		$query_str .= " and ListPrice <=".$_REQUEST['max_price'];
		$query_string .= '&max_price='.$_REQUEST['max_price'];
	}
	if(!empty($_REQUEST['min_price']) && !empty($_REQUEST['max_price']))
	{
		$query_str .= " and ListPrice >=".$_REQUEST['min_price']." and ListPrice <=".$_REQUEST['max_price'];
		$query_string .= '&min_price='.$_REQUEST['min_price'].'&max_price='.$_REQUEST['max_price'];
	}
	
	$query_str .= " and liststatus='Active' and mlsnum<>'13340274' and (LATITUDE IS NOT NULL AND LATITUDE <> '') order by LISTPRICE desc";
	
	//$sql_str = "SELECT BATHSFULL,BATHSHALF,BATHSTOTAL,STREETNUM,STREETDIR,STREETNAME,STREETTYPE,CITY,STATE,ZIPCODE,BEDS,GARAGECAP,SQFTTOTAL,MLSNUM,LISTPRICE,LATITUDE,LONGITUDE,PHOTO_URL,permalink,PHOTOCOUNT FROM ".$sel_table." where ".$query_str;
	$sql_str = "SELECT SQL_CALC_FOUND_ROWS BATHSFULL,BATHSHALF,BATHSTOTAL,STREETNUM,STREETDIR,STREETNAME,STREETTYPE,CITY,STATE,ZIPCODE,BEDS,GARAGECAP,SQFTTOTAL,MLSNUM,LISTPRICE,LATITUDE,LONGITUDE,photo1_url,permalink,PHOTOCOUNT FROM ".$sel_table." where ".$query_str;
	
	$p = (isset($_GET['page'])) ? $_GET['page'] : 1;
	
	$o__pager = new pager($sel_table,$p ,50,'',$sql_str  );
	$q = $o__pager->getQuery();	
	
	
	//$result = mysql_query("SELECT MLSNUM FROM ".$sel_table." where ".$query_str);
	$resultID2 = mysql_query("SELECT FOUND_ROWS() as total");
	$listing_array2 = mysql_fetch_assoc($resultID2);
	
	
	
	while($row = mysql_fetch_assoc($q)) {
		$propLists[] = $row;
	}
	
?>
<?php $j=1; $str = '';
		foreach($propLists as $propList) {
			$fin_bath_room = '';
			$totalbaths = '';
			if(!empty($propList['BATHSFULL'])) 
				$fin_bath_room .= $propList['BATHSFULL'];	
			if(!empty($propList['BATHSHALF'])) 
				$fin_bath_room .= '.'.$propList['BATHSHALF'];	
				
			
			if(!empty($propList['BATHSTOTAL'])):		
				$totalbaths = $propList['BATHSTOTAL'];
			else:
				$totalbaths = $fin_bath_room;
			endif;		
			
			
			$tmp_addr = $propList['STREETNUM'].' '.$propList['STREETDIR'].' '.$propList['STREETNAME'].' '.$propList['STREETTYPE'].'<br/>'.$propList['CITY'].' '.$propList['STATE'].' '.$propList['ZIPCODE'].'<br/>'.$propList['BEDS'].(($propList['BEDS']>1)?' Beds':' Bed').'&nbsp;&nbsp;'.$totalbaths.(($totalbaths>1)?' Baths':' Bath').'&nbsp;&nbsp;'.$propList['GARAGECAP'].(($propList['GARAGECAP']>1)?' Garages':' Garage').'<br/>'.number_format($propList['SQFTTOTAL']).' Sqft&nbsp;&nbsp;MLS: '.$propList['MLSNUM'];
			
			$str .= '{"id": '.$j.',"title": "'.strstr(money_format('%n', $propList['LISTPRICE']),'.',true).'","latitude":'.$propList['LATITUDE'].',"longitude":'.$propList['LONGITUDE'].',"image":"'.str_replace('http://matrixrets.ntreis.net/Rets/GetRetsMedia.ashx','http://matrixmedia.ntreis.net/mediaserver/GetMedia.ashx',$propList['photo1_url']).'","description":"'.$tmp_addr.'","link":"'.site_url.'property_details/'.$propList['permalink'].'/'.str_replace(' ','-',$proptype).'","map_marker_icon":"'.site_url.'images/markers/coral-marker-residential.png"},';
		$j++; } $str = substr_replace($str, "", -1); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Houzez HTML5 Template</title>
    <!--Meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Houzez HTML5 Template">
    <meta name="description" content="Houzez HTML5 Template">
    <meta name="author" content="Favethemes">

    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo site_url?>images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?php echo site_url?>images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo site_url?>images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo site_url?>images/favicons/manifest.json">
    <link rel="mask-icon" href="<?php echo site_url?>images/favicons/safari-pinned-tab.svg" >
    <meta name="theme-color" content="#ffffff">

    <?php include_once('style.php'); ?>
</head>
<body style="overflow:hidden">

<button class="btn scrolltop-btn back-top"><i class="fa fa-angle-up"></i></button>
<div class="modal fade" id="pop-login" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="login-tabs">
                    <li class="active">Login</li>
                    <li>Register</li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>

            </div>
            <div class="modal-body login-block">
                <div class="tab-content">
                    <div class="tab-pane fade in active">
                        <div class="message">
                            <p class="error text-danger"><i class="fa fa-close"></i> You are not Logedin</p>
                            <p class="success text-success"><i class="fa fa-check"></i> You are not Logedin</p>
                        </div>
                        <form>
                            <div class="form-group field-group">
                                <div class="input-user input-icon">
                                    <input type="text" placeholder="Username">
                                </div>
                                <div class="input-pass input-icon">
                                    <input type="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="forget-block clearfix">
                                <div class="form-group pull-left">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group pull-right">
                                    <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#pop-reset-pass">I forgot username and password</a>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <hr>
                        <a href="#" class="btn btn-social btn-bg-facebook btn-block"><i class="fa fa-facebook"></i> login with facebook</a>
                        <a href="#" class="btn btn-social btn-bg-linkedin btn-block"><i class="fa fa-linkedin"></i> login with linkedin</a>
                        <a href="#" class="btn btn-social btn-bg-google-plus btn-block"><i class="fa fa-google-plus"></i> login with Google</a>
                    </div>
                    <div class="tab-pane fade">
                        <form>
                            <div class="form-group field-group">
                                <div class="input-user input-icon">
                                    <input type="text" placeholder="Username">
                                </div>
                                <div class="input-email input-icon">
                                    <input type="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        I agree with your <a href="#">Terms & Conditions</a>.
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                        <hr>

                        <a href="#" class="btn btn-social btn-bg-facebook btn-block"><i class="fa fa-facebook"></i> login with facebook</a>
                        <a href="#" class="btn btn-social btn-bg-linkedin btn-block"><i class="fa fa-linkedin"></i> login with linkedin</a>
                        <a href="#" class="btn btn-social btn-bg-google-plus btn-block"><i class="fa fa-google-plus"></i> login with Google</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="pop-reset-pass" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="login-tabs">
                    <li class="active">Reset Password</li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <p>Please enter your username or email address. You will receive a link to create a new password via email.</p>
                <form>
                    <div class="form-group">
                        <div class="input-user input-icon">
                            <input placeholder="Enter your username or email" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block">Get new password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--start header section header v1-->
<?php include_once('header.php'); ?>
<style>
	html, body, #map-canvas {
      height: 600px;
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
	 
 	.gm-style-iw + div {display: none;}
</style>
<div class="header-mobile visible-sm visible-xs">
    <div class="container">
        <!--start mobile nav-->
        <div class="mobile-nav">
            <span class="nav-trigger"><i class="fa fa-navicon"></i></span>
            <div class="nav-dropdown main-nav-dropdown"></div>
        </div>
        <!--end mobile nav-->
        <div class="header-logo">
            <a href="index.html"><img src="<?php echo site_url?>images/logo-houzez-white.png" alt="logo"></a>
        </div>
        <div class="header-user">
            <ul class="account-action">
                <li>
                    <span class="user-icon"><i class="fa fa-user"></i></span>
                    <div class="account-dropdown">
                        <ul>
                            <li> <a href="add-new-property.html"> <i class="fa fa-plus-circle"></i>Creat Listing</a></li>
                            <li> <a href="#" data-toggle="modal" data-target="#pop-login"> <i class="fa fa-user"></i> Log in / Register </a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--end header section header v1-->

    <!--start section page body-->
    <section id="section-body" class="houzez-body-half">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12 no-padding">
                    <div class="map-half fave-screen-fix">
                        <div id="houzez-gmap-main" class="fave-screen-fix">
                            <!--<div class="mapPlaceholder">
                                <div class="loader-ripple">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>-->
                            <div id="map-canvas"></div>
                            
                            <!--<div  class="map-arrows-actions">
                                <button id="listing-mapzoomin" class="map-btn"><i class="fa fa-plus"></i> </button>
                                <button id="listing-mapzoomout" class="map-btn"><i class="fa fa-minus"></i></button>
                                <input type="text" id="google-map-search" placeholder="Google Map Search" class="map-search">
                            </div>
                            <div class="map-next-prev-actions">
                                <ul class="dropdown-menu" aria-labelledby="houzez-gmap-view">
                                    <li><a href="#" onclick="fave_change_map_type('roadmap')"><span>Roadmap</span></a></li>
                                    <li><a href="#" onclick="fave_change_map_type('satellite')"><span>Satelite</span></a></li>
                                    <li><a href="#" onclick="fave_change_map_type('hybrid')"><span>Hybrid</span></a></li>
                                    <li><a href="#" onclick="fave_change_map_type('terrain')"><span>Terrain</span></a></li>
                                </ul>
                                <button id="houzez-gmap-view" class="map-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-globe"></i> <span>View</span></button>

                                <button id="houzez-gmap-prev" class="map-btn"><i class="fa fa-chevron-left"></i> <span>Prev</span></button>
                                <button id="houzez-gmap-next" class="map-btn"><span>Next</span> <i class="fa fa-chevron-right"></i></button>
                            </div>
                            <div class="map-zoom-actions">
                                <span id="houzez-gmap-location" class="map-btn"><i class="fa fa-map-marker"></i> <span>My location</span></span>
                                <span id="houzez-gmap-full" class="map-btn"><i class="fa fa-arrows-alt"></i> <span>Fullscreen</span></span>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 no-padding" style="background-color: white;
    bottom: 0;
    height: auto;
    left: auto;
    opacity: 1;
    overflow: hidden;
    position: absolute;
    right: 0;
    top: 50px;
    transition: none 0s ease 0s ;
    z-index: 4;">
                    <div class="module-half fave-screen-fix" style="height: 100%; overflow-x: hidden; overflow-y: scroll; position: static;">

                        <!--<div class="advanced-search houzez-adv-price-range">
                            <form method="post" action="#">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group table-list search-long">
                                            <div class="input-search input-icon">
                                                <input type="text" class="form-control" value="" name="keyword" placeholder="Enter an address, town, street, or zip">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <div class="search-location">
                                                <input class="form-control" type="text" placeholder="Location">
                                                <i class="location-trigger fa fa-dot-circle-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 col-xs-4">
                                        <div class="form-group">
                                            <div class="radius-text-wrap">
                                                <label class="checkbox-inline">
                                                    <input value="option1" type="checkbox"> Radius: <strong><span id="area-range-text">0</span> km</strong>
                                                </label>
                                                <input type="hidden" id="area-range-value" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9 col-xs-8">
                                        <div class="radius-range-wrap">
                                            <div id="area-range-slider"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group">
                                            <select class="selectpicker" name="status" data-live-search="false" data-live-search-style="begins">
                                                <option>Status 1</option>
                                                <option>Status 2</option>
                                                <option>Status 3</option>
                                                <option>Status 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group">
                                            <select class="selectpicker" name="type" data-live-search="false" data-live-search-style="begins">
                                                <option>Type 1</option>
                                                <option>Type 2</option>
                                                <option>Type 3</option>
                                                <option>Type 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group">
                                            <select name="bedrooms" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="Bedrooms">
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group">
                                            <select name="bathrooms" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="Bathrooms">
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="" name="min-area" placeholder="Min Area">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="" name="max-area" placeholder="Max Area">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="input-calendar input-icon input-icon-right">
                                                <input name="publish_date" class="form-control input_date" placeholder="Available from" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <label class="advance-trigger"><i class="fa fa-plus-square"></i> Other Features </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="features-list field-expand">
                                            <label class="checkbox-inline">
                                                <input value="option1" type="checkbox"> Feature
                                            </label>
                                            <label class="checkbox-inline">
                                                <input value="option2" type="checkbox"> Feature
                                            </label>
                                            <label class="checkbox-inline">
                                                <input value="option3" type="checkbox"> Feature
                                            </label>
                                            <label class="checkbox-inline">
                                                <input value="option1" type="checkbox"> Feature
                                            </label>
                                            <label class="checkbox-inline">
                                                <input value="option2" type="checkbox"> Feature
                                            </label>
                                            <label class="checkbox-inline">
                                                <input value="option3" type="checkbox"> Feature
                                            </label>
                                            <label class="checkbox-inline">
                                                <input value="option1" type="checkbox"> Feature
                                            </label>
                                            <label class="checkbox-inline">
                                                <input value="option2" type="checkbox"> Feature
                                            </label>
                                            <label class="checkbox-inline">
                                                <input value="option3" type="checkbox"> Feature
                                            </label>
                                            <label class="checkbox-inline">
                                                <input value="option1" type="checkbox"> Feature
                                            </label>
                                            <label class="checkbox-inline">
                                                <input value="option2" type="checkbox"> Feature
                                            </label>
                                            <label class="checkbox-inline">
                                                <input value="option3" type="checkbox"> Feature
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>-->

                        <!--start carousel module-->
                        <!--<div class="houzez-module caption-above carousel-module">
                            <div class="row no-margin">
                                <div class="module-title-nav clearfix">
                                    <div>
                                        <h2>Featured Properties</h2>
                                    </div>
                                    <div class="module-nav">
                                        <button class="btn btn-sm btn-crl-2-prev">Prev</button>
                                        <button class="btn btn-sm btn-crl-2-next">Next</button>
                                        <a href="#" class="btn btn-carousel btn-sm">All</a>
                                    </div>
                                </div>
                                <div id="properties-carousel-2" class="carousel slide-animated">
                                    <div class="item">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <div class="label-wrap label-left">
                                                    <span class="label label-success">Featured</span>
                                                    <span class="label-status label label-default">For Sale</span>
                                                </div>
                                                <a href="#" class="hover-effect">
                                                    <img src="http://placehold.it/584x349" width="584" height="349" alt="Image">
                                                </a>
                                                <ul class="actions">
                                                    <li>
                                                    <span title="" data-placement="bottom" data-toggle="tooltip" data-original-title="Favorite">
                                                        <i class="fa fa-heart-o"></i>
                                                    </span>
                                                    </li>
                                                    <li class="share-btn">
                                                        <div class="share_tooltip fade">
                                                            <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                        </div>
                                                        <span title="" data-placement="bottom" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                    </li>
                                                </ul>
                                                <div class="thumb-caption">
                                                    <div class="cap-price pull-left">$350,000</div>
                                                </div>
                                                <div class="detail-above detail">
                                                    <div class="fig-title clearfix">
                                                        <h3 class="pull-left">Apartment Oceanview</h3>
                                                    </div>

                                                    <ul class="list-inline">
                                                        <li class="cap-price">$350,000</li>
                                                        <li>2 bd</li>
                                                        <li>3 ba</li>
                                                        <li>1,287 sqft</li>
                                                    </ul>
                                                </div>
                                            </figure>
                                            <div class="detail-bottom detail">
                                                <h3>Apartment Oceanview</h3>
                                                <ul class="list-inline">
                                                    <li>2 bd</li>
                                                    <li>3 ba</li>
                                                    <li>1,287 sqft</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <div class="label-wrap label-left">
                                                    <span class="label label-success">Featured</span>
                                                    <span class="label-status label label-default">For Sale</span>
                                                </div>
                                                <a href="#" class="hover-effect">
                                                    <img src="http://placehold.it/584x349" width="584" height="349" alt="Image">
                                                </a>
                                                <ul class="actions">
                                                    <li>
                                                    <span title="" data-placement="bottom" data-toggle="tooltip" data-original-title="Favorite">
                                                        <i class="fa fa-heart-o"></i>
                                                    </span>
                                                    </li>
                                                    <li class="share-btn">
                                                        <div class="share_tooltip fade">
                                                            <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                        </div>
                                                        <span title="" data-placement="bottom" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                    </li>
                                                </ul>
                                                <div class="thumb-caption">
                                                    <div class="cap-price pull-left">$350,000</div>
                                                </div>
                                                <div class="detail-above detail">
                                                    <div class="fig-title clearfix">
                                                        <h3 class="pull-left">Apartment Oceanview</h3>
                                                    </div>

                                                    <ul class="list-inline">
                                                        <li class="cap-price">$350,000</li>
                                                        <li>2 bd</li>
                                                        <li>3 ba</li>
                                                        <li>1,287 sqft</li>
                                                    </ul>
                                                </div>
                                            </figure>
                                            <div class="detail-bottom detail">
                                                <h3>Apartment Oceanview</h3>
                                                <ul class="list-inline">
                                                    <li>2 bd</li>
                                                    <li>3 ba</li>
                                                    <li>1,287 sqft</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <div class="label-wrap label-left">
                                                    <span class="label label-success">Featured</span>
                                                    <span class="label-status label label-default">For Sale</span>
                                                </div>
                                                <a href="#" class="hover-effect">
                                                    <img src="http://placehold.it/584x349" width="584" height="349" alt="Image">
                                                </a>
                                                <ul class="actions">
                                                    <li>
                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                        <i class="fa fa-heart-o"></i>
                                                    </span>
                                                    </li>
                                                    <li class="share-btn">
                                                        <div class="share_tooltip fade">
                                                            <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                        </div>
                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                    </li>
                                                </ul>
                                                <div class="thumb-caption">
                                                    <div class="cap-price pull-left">$350,000</div>
                                                </div>
                                                <div class="detail-above detail">
                                                    <div class="fig-title clearfix">
                                                        <h3 class="pull-left">Apartment Oceanview</h3>
                                                    </div>

                                                    <ul class="list-inline">
                                                        <li class="cap-price">$350,000</li>
                                                        <li>2 bd</li>
                                                        <li>3 ba</li>
                                                        <li>1,287 sqft</li>
                                                    </ul>
                                                </div>
                                            </figure>
                                            <div class="detail-bottom detail">
                                                <h3>Apartment Oceanview</h3>
                                                <ul class="list-inline">
                                                    <li>2 bd</li>
                                                    <li>3 ba</li>
                                                    <li>1,287 sqft</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <div class="label-wrap label-left">
                                                    <span class="label label-success">Featured</span>
                                                    <span class="label-status label label-default">For Sale</span>
                                                </div>
                                                <a href="#" class="hover-effect">
                                                    <img src="http://placehold.it/584x349" width="584" height="349" alt="Image">
                                                </a>
                                                <ul class="actions">
                                                    <li>
                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                        <i class="fa fa-heart-o"></i>
                                                    </span>
                                                    </li>
                                                    <li class="share-btn">
                                                        <div class="share_tooltip fade">
                                                            <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                        </div>
                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                    </li>
                                                </ul>
                                                <div class="thumb-caption">
                                                    <div class="cap-price pull-left">$350,000</div>
                                                </div>
                                                <div class="detail-above detail">
                                                    <div class="fig-title clearfix">
                                                        <h3 class="pull-left">Apartment Oceanview</h3>
                                                    </div>

                                                    <ul class="list-inline">
                                                        <li class="cap-price">$350,000</li>
                                                        <li>2 bd</li>
                                                        <li>3 ba</li>
                                                        <li>1,287 sqft</li>
                                                    </ul>
                                                </div>
                                            </figure>
                                            <div class="detail-bottom detail">
                                                <h3>Apartment Oceanview</h3>
                                                <ul class="list-inline">
                                                    <li>2 bd</li>
                                                    <li>3 ba</li>
                                                    <li>1,287 sqft</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <div class="label-wrap label-left">
                                                    <span class="label label-success">Featured</span>
                                                    <span class="label-status label label-default">For Sale</span>
                                                </div>
                                                <a href="#" class="hover-effect">
                                                    <img src="http://placehold.it/584x349" width="584" height="349" alt="Image">
                                                </a>
                                                <ul class="actions">
                                                    <li>
                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                        <i class="fa fa-heart-o"></i>
                                                    </span>
                                                    </li>
                                                    <li class="share-btn">
                                                        <div class="share_tooltip fade">
                                                            <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                        </div>
                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                    </li>
                                                </ul>
                                                <div class="thumb-caption">
                                                    <div class="cap-price pull-left">$350,000</div>
                                                </div>
                                                <div class="detail-above detail">
                                                    <div class="fig-title clearfix">
                                                        <h3 class="pull-left">Apartment Oceanview</h3>
                                                    </div>

                                                    <ul class="list-inline">
                                                        <li class="cap-price">$350,000</li>
                                                        <li>2 bd</li>
                                                        <li>3 ba</li>
                                                        <li>1,287 sqft</li>
                                                    </ul>
                                                </div>
                                            </figure>
                                            <div class="detail-bottom detail">
                                                <h3>Apartment Oceanview</h3>
                                                <ul class="list-inline">
                                                    <li>2 bd</li>
                                                    <li>3 ba</li>
                                                    <li>1,287 sqft</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!--end carousel module-->

                        <!--start latest listing module-->
                        <div class="houzez-module">
                            <!--start list tabs-->
                            <div class="list-tabs table-list full-width">
                                <div class="tabs table-cell">
                                    <h2 class="tabs-title">Half Map</h2>
                                </div>
                                <div class="sort-tab table-cell text-right">
                                    <span class="view-btn btn-list active"><i class="fa fa-th-list"></i></span>
                                    <span class="view-btn btn-grid"><i class="fa fa-th-large"></i></span>
                                </div>
                            </div>
                            
                            <!--<div id="markers_info">
                                <div class="marker">Manneken Pis,   50.84498605,4.349977747</div>
                                <div class="marker">Jeanneke Pis,   50.84848913,4.354053363</div>
                                <div class="marker">Grand Place,    50.84673465,4.352466166</div>
                                <div class="marker">Preston Office, 32.85333440000001,-96.80425249999999</div>
                            </div>-->
                            
                            <!--end list tabs-->
                            <div class="property-listing list-view">
                                <div class="row" id="markers_info">
                                    <?php if(!empty($propLists)): ?>
                                    <?php foreach($propLists as $propList): ?>
                                        <div class="item-wrap">
                                                <div class="property-item-grid">
                                                    <figure class="item-thumb">
                                                        <a href="#" class="hover-effect">
                                                            <img src="<?php echo $propList['photo1_url'] ?>" alt="thumb">
                                                        </a>
                                                        <div class="label-wrap label-left">
                                                            <span class="label label-success">Featured</span>
                                                            <span class="label label-danger">Open House</span>
                                                        </div>
                                                        <div class="price">
                                                            <span class="item-price"><?php echo strstr(money_format('%n', $propList['LISTPRICE']),'.',true) ?></span>
                                                            <span class="item-sub-price">$21,000/mo</span>
                                                        </div>
                                                        <ul class="actions">
                                                            <li>
                                                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                    <i class="fa fa-heart"></i>
                                                                </span>
                                                            </li>
                                                            <li class="share-btn">
                                                                <div class="share_tooltip fade">
                                                                    <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                                </div>
                                                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                            </li>
                                                            <li>
                                                                <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                    <i class="fa fa-camera"></i>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                        <div class="item-caption">
                                                            <div class="label-wrap">
                                                                <span class="label label-primary">For Sale</span>
                                                            </div>
                                                            <h4 class="item-caption-title">Luxury apartment bay view</h4>
                                                            <ul class="item-caption-list">
                                                                <li>2 bd</li>
                                                                <li>3 ba</li>
                                                                <li>1,287 sqft</li>
                                                            </ul>
                                                        </div>
                                                    </figure>
                                                </div>
                                            </div>
                                		<?php endforeach; ?>   
                                	<?php endif; ?>         
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
    
    <?php include_once('footer.php'); ?>
<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAFqAPWaxVQnJMkCBEHvlP1fIqevvgoN44&#038;libraries=geometry%2Cplaces%2Cdrawing&#038;ver=4.7.4'></script>
    <script type="text/javascript" src="<?php echo site_url ?>js/bootstrap-datetimepicker.min.js"></script>
	<!--<script type="text/javascript" src="js/masonry.pkgd.min.js"></script>-->
    <script type="text/javascript" src="<?php echo site_url ?>js/infobox.js"></script>
    <script type="text/javascript" src="<?php echo site_url ?>js/markerclusterer.js"></script>
    
    
    
    <script type="text/javascript">

        /*(function($){
            var theMap;
            function initMap() {

               
                var properties = [{
                    id: 294,
                    title: "Penthouse apartment",
                    lat: "40.6879438",
                    lng: "-73.94192980000003",
                    address:"Quincy St, Brooklyn, NY, USA",
                    bathrooms:"2",
                    bedrooms:"3",
                    icon:"<?php echo site_url?>images/map/pin-apartments.png",
                    images_count:7,
                    price:"<span class='item-price'>$876,000</span><span class='item-sub-price'>$7,600&#47;sq ft</span>",
                    is_featured:"",
                    prop_meta:"<p><span>Beds: 3</span><span>Baths: 2</span><span>Sq Ft: 2560</span></p>",
                    retinaIcon:"<?php echo site_url?>images/map/pin-apartments.png",
                    thumbnail:"<img src='http://placehold.it/385x258' alt='thumb'>",
                    type:"Apartment",
                    url:"/"
                },
                {
                    id: 285,
                    title: "Confortable apartment",
                    lat: "41.72305619999999",
                    lng: "-74.03885300000002",
                    address:"Metro Plaza Dr, Jersey City, NJ 07302, USA",
                    bathrooms:"2",
                    bedrooms:"1",
                    icon:"<?php echo site_url?>images/map/pin-house.png",
                    images_count:7,
                    price:"<span class='item-price'>$3,700&#47;mo</span>",
                    is_featured:"",
                    prop_meta:"<p><span>Bed: 1</span><span>Baths: 2</span><span>Sq Ft: 1900</span></p>",
                    retinaIcon:"http://sandbox.favethemes.com/houzez/wp-content/uploads/2016/02/x2-apartment.png",
                    thumbnail:"<img src='http://placehold.it/385x258' alt='thumb'>",
                    type:"Apartment",
                    url:"/"
                }];

                var myLatLng = new google.maps.LatLng(properties[1].lat,properties[1].lng);

                var houzezMapOptions = {
                    zoom: 12,
                    center: myLatLng,
                    disableDefaultUI: true,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scroll:{x:$(window).scrollLeft(),y:$(window).scrollTop()}
                };
                var theMap = new google.maps.Map(document.getElementById("map"), houzezMapOptions);

                var markers = new Array();
                var current_marker = 0;
                var visible;

                var offset=$(theMap.getDiv()).offset();
                theMap.panBy(((houzezMapOptions.scroll.x-offset.left)/3),((houzezMapOptions.scroll.y-offset.top)/3));
                google.maps.event.addDomListener(window, 'scroll', function(){
                    var scrollY=$(window).scrollTop(),
                            scrollX=$(window).scrollLeft(),
                            scroll=theMap.get('scroll');
                    if(scroll){
                        theMap.panBy(-((scroll.x-scrollX)/3),-((scroll.y-scrollY)/3));
                    }
                    theMap.set('scroll',{x:scrollX,y:scrollY});
                });

                var mapBounds = new google.maps.LatLngBounds();

                for( i = 0; i < properties.length; i++ ) {
                    var marker_url = properties[i].icon;
                    var marker_size = new google.maps.Size( 44, 56 );
                    if( window.devicePixelRatio > 1.5 ) {
                        if ( properties[i].retinaIcon ) {
                            marker_url = properties[i].retinaIcon;
                            marker_size = new google.maps.Size( 84, 106 );
                        }
                    }

                    var marker_icon = {
                        url: marker_url,
                        size: marker_size,
                        scaledSize: new google.maps.Size( 44, 56 ),
                        origin: new google.maps.Point( 0, 0 ),
                        anchor: new google.maps.Point( 7, 27 )
                    };

                    // Markers
                    markers[i] = new google.maps.Marker({
                        map: theMap,
                        draggable: false,
                        position: new google.maps.LatLng(properties[0].lat,properties[0].lng),
                        icon: marker_icon,
                        title: properties[i].title,
                        animation: google.maps.Animation.DROP,
                        visible: true
                    });

                    mapBounds.extend(markers[i].getPosition());

                    var infoBoxText = document.createElement("div");
                    infoBoxText.className = 'property-item item-grid map-info-box';
                    infoBoxText.innerHTML =
                            '<div class="figure-block">'+
                            '<figure class="item-thumb">'+
                            properties[i].is_featured +
                            '<div class="price hide-on-list">'+
                            properties[i].price +
                            '</div>'+
                            '<a href="'+properties[i].url+'" tabindex="0">'+
                            properties[i].thumbnail +
                            '</a>'+
                            '<div class="thumb-caption cap-actions clearfix">'+
                            '<div class="pull-right">'+
                            '<span title="" data-placement="top" data-toggle="tooltip" data-original-title="Photos">'+
                            '<i class="fa fa-camera"></i> <span class="count">('+ properties[i].images_count +')</span>'+
                            '</span>'+
                            '</div>'+
                            '</div>'+
                            '</figure>'+
                            '</div>' +
                            '<div class="item-body">' +
                            '<div class="body-left">' +
                            '<div class="info-row">' +
                            '<h2 class="property-title"><a href="'+properties[i].url+'">'+properties[i].title+'</a></h2>' +
                            '<h4 class="property-location">'+properties[i].address+'</h4>' +
                            '</div>' +
                            '<div class="table-list full-width info-row">' +
                            '<div class="cell">' +
                            '<div class="info-row amenities">' +
                            properties[i].prop_meta +
                            '<p>'+properties[i].type+'</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';


                    var infoBoxOptions = {
                        content: infoBoxText,
                        disableAutoPan: true,
                        maxWidth: 0,
                        alignBottom: true,
                        pixelOffset: new google.maps.Size( -122, -48 ),
                        zIndex: null,
                        closeBoxMargin: "0 0 -16px -16px",
                        closeBoxURL: "<?php echo site_url?>images/map/close.png",
                        infoBoxClearance: new google.maps.Size( 1, 1 ),
                        isHidden: false,
                        pane: "floatPane",
                        enableEventPropagation: false
                    };

                    var infobox = new InfoBox( infoBoxOptions );

                    attachInfoBoxToMarker( theMap, markers[i], infobox );

                }

                if(  document.getElementById('listing-mapzoomin') ){
                    google.maps.event.addDomListener(document.getElementById('listing-mapzoomin'), 'click', function () {
                        var current= parseInt( theMap.getZoom(),10);
                        current++;
                        if(current > 20){
                            current = 20;
                        }
                        theMap.setZoom(current);
                    });
                }


                if(  document.getElementById('listing-mapzoomout') ){
                    google.maps.event.addDomListener(document.getElementById('listing-mapzoomout'), 'click', function () {
                        var current= parseInt( theMap.getZoom(),10);
                        current--;
                        if(current < 0){
                            current = 0;
                        }
                        theMap.setZoom(current);
                    });
                }

                // Marker Clusters
                //if( googlemap_pin_cluster != 'no' ) {
                var markerClustererOptions = {
                    ignoreHidden: true,
                    maxZoom: parseInt(10),
                    styles: [{
                        textColor: '#ffffff',
                        url: '<?php echo site_url?>images/map/cluster-icon.png',
                        height: 48,
                        width: 48
                    }]
                };

                var markerClusterer = new MarkerClusterer(theMap, markers, markerClustererOptions);
                //}

                theMap.fitBounds(mapBounds);

                function attachInfoBoxToMarker( map, marker, infoBox ){
                    marker.addListener('click', function() {
                        var scale = Math.pow( 2, map.getZoom() );
                        var offsety = ( (100/scale) || 0 );
                        var projection = map.getProjection();
                        var markerPosition = marker.getPosition();
                        var markerScreenPosition = projection.fromLatLngToPoint( markerPosition );
                        var pointHalfScreenAbove = new google.maps.Point( markerScreenPosition.x, markerScreenPosition.y - offsety );
                        var aboveMarkerLatLng = projection.fromPointToLatLng( pointHalfScreenAbove );
                        map.setCenter( aboveMarkerLatLng );
                        infoBox.close();
                        infoBox.open( map, marker );
                    });
                }

                jQuery('#houzez-gmap-next').on('click',function(){
                    current_marker++;
                    if ( current_marker > markers.length ){
                        current_marker = 1;
                    }
                    while( markers[current_marker-1].visible===false ){
                        current_marker++;
                        if ( current_marker > markers.length ){
                            current_marker = 1;
                        }
                    }
                    if( theMap.getZoom() < 15 ){
                        theMap.setZoom(15);
                    }
                    google.maps.event.trigger( markers[current_marker-1], 'click' );
                });

                jQuery('#houzez-gmap-prev').on('click',function(){
                    current_marker--;
                    if (current_marker < 1){
                        current_marker = markers.length;
                    }
                    while( markers[current_marker-1].visible===false ){
                        current_marker--;
                        if ( current_marker > markers.length ){
                            current_marker = 1;
                        }
                    }
                    if( theMap.getZoom() <15 ){
                        theMap.setZoom(15);
                    }
                    google.maps.event.trigger( markers[current_marker-1], 'click');
                });
                jQuery('#houzez-gmap-full').on('click',function() {
                    //google.maps.event.trigger(theMap, 'resize');
                    if($(this).hasClass('active')== true){
                        //alert('has');
                        google.maps.event.trigger(theMap, 'resize');
                        theMap.setOptions({
                            draggable: true,
                        });
                    }else{
                        //alert('not has');
                        google.maps.event.trigger(theMap, 'resize');
                        theMap.setOptions({
                            draggable: false,
                        });
                    }

                });


                fave_change_map_type = function(map_type){

                    if(map_type==='roadmap'){
                        theMap.setMapTypeId(google.maps.MapTypeId.ROADMAP);
                    }else if(map_type==='satellite'){
                        theMap.setMapTypeId(google.maps.MapTypeId.SATELLITE);
                    }else if(map_type==='hybrid'){
                        theMap.setMapTypeId(google.maps.MapTypeId.HYBRID);
                    }else if(map_type==='terrain'){
                        theMap.setMapTypeId(google.maps.MapTypeId.TERRAIN);
                    }
                    return false;
                };

                // Create the search box and link it to the UI element.
                //var input = document.getElementById('google-map-search');
                //var searchBox = new google.maps.places.SearchBox(input);
                //theMap.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                

                //var markers_location = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.

                google.maps.event.addListenerOnce(theMap, 'tilesloaded', function() {
                    $('.mapPlaceholder').hide();
                });

            }

            google.maps.event.addDomListener( window, 'load', initMap );
        })(jQuery)*/
		
		jQuery(document).ready(function() {
			// initiate Google maps
			initialize();
			
			google.maps.event.addListener(infowindow, 'domready', function() {

				   // Reference to the DIV which receives the contents of the infowindow using jQuery
				   var iwOuter = jQuery('.gm-style-iw');
				
				   /* The DIV we want to change is above the .gm-style-iw DIV.
					* So, we use jQuery and create a iwBackground variable,
					* and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
					*/
				   var iwBackground = iwOuter.prev();
				
				   // Remove the background shadow DIV
				   iwBackground.children(':nth-child(2)').css({'display' : 'none'});
				
				   // Remove the white background DIV
				   iwBackground.children(':nth-child(4)').css({'display' : 'none'});
				
				});
			
			// make a .hover event
			jQuery('#markers_info .item-wrap').hover( 
			  // mouse in
			  function () {
				// first we need to know which <div class="marker"></div> we hovered
				
				
				
				var index = jQuery('#markers_info .item-wrap').index(this);
				
				if (that) {
					that.setZIndex();
				}
				that = markers[index];
				
				markers[index].setIcon(highlightedIcon());
				markers[index].setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
				//this.setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
			  },
			  // mouse out
			  function () {
				// first we need to know which <div class="marker"></div> we hovered
				var index = jQuery('#markers_info .item-wrap').index(this);
				markers[index].setIcon(normalIcon());
			  }
		
			);
		  });
		  /**
			Google Maps stuff
		  */
			/*var markerData = [   // the order of these markers must be the same as the <div class="marker"></div> elements
			  {lat: 50.84498605, lng: 4.349977747, title: '$130K'},
			  {lat: 50.64848913, lng: 4.354753363, title: '$450K'},
			  {lat: 50.74673465, lng: 4.352666166, title: '$500K'},
			  {lat: 51.94673465, lng: 4.353566166, title: '$1M'}
			];
			alert(markerData);*/
			//var markerData = [];
			<?php if(!empty($propLists)): $str = ''; ?>
              	<?php foreach($propLists as $propList): ?>
					<?php $str .= "{lat: ".$propList['LATITUDE'].", lng: ".$propList['LONGITUDE'].", title: '".kmprice($propList['LISTPRICE'])."', price: '".$propList['LISTPRICE']."', image: '".$propList['photo1_url']."', mlsnum: '".$propList['MLSNUM']."'},"; ?>
				<?php endforeach; ?>   
            <?php endif; $str = substr($str, 0, -1); ?>      
			
			var markerData = [   // the order of these markers must be the same as the <div class="marker"></div> elements
			  <?php echo $str ?>
			];
			
			//alert(markerData);
			
			var map;
			var that;
			var markers = [];
			var infoWindow_arr;
			var prevIndex;
			var mapOptions = {
			  zoom: 15,
			  center: new google.maps.LatLng(<?php echo $propLists[0]['LATITUDE'] ?>,<?php echo $propLists[0]['LONGITUDE'] ?>),  // Brussels, Belgium
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			
			function addInfoWindow(marker, message) {
				
				var infoWindow = new google.maps.InfoWindow({
					content: message
				});
				
				google.maps.event.addListener(marker, 'click', function () {
					if (infoWindow_arr) {
						infoWindow_arr.close();
					}
					
					var index = jQuery('#markers_info .item-wrap').index(this);
					
					//prevIndex = index;
					/*if (prevIndex) {
						prevIndex.setIcon(normalIcon());
					}*/
					
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
				});
				
				
				
				
				
				
	google.maps.event.addListener(infoWindow, 'domready', function() {

    // Reference to the DIV that wraps the bottom of infowindow
    var iwOuter = $('.gm-style-iw');

    /* Since this div is in a position prior to .gm-div style-iw.
     * We use jQuery and create a iwBackground variable,
     * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
    */
    var iwBackground = iwOuter.prev();

    // Removes background shadow DIV
    iwBackground.children(':nth-child(2)').css({'display' : 'none'});

    // Removes white background DIV
    iwBackground.children(':nth-child(4)').css({'display' : 'none'});

    // Moves the infowindow 115px to the right.
    iwOuter.parent().parent().css({left: '0px',top: '55px','z-index': '-107'});

    // Moves the shadow of the arrow 76px to the left margin.
    iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'display: none !important;'});

    // Moves the arrow 76px to the left margin.
    iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'display: none !important;'});

    // Changes the desired tail shadow color.
    //iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

    /*// Reference to the div that groups the close button elements.
    var iwCloseBtn = iwOuter.next();

    // Apply the desired effect to the close button
    iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});*/

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
		
			function initialize() {
			  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
			  
			  //google.maps.Icon.labelOrigin = "top-left";
			  
			  var bounds = new google.maps.LatLngBounds();
			  
			  for (var i=0; i<markerData.length; i++) {
				//markers.push(
				  
				  var marker = new google.maps.Marker({
					position: new google.maps.LatLng(markerData[i].lat, markerData[i].lng),
					title: markerData[i].title,
					label: {text: markerData[i].title, color: "black", fontSize:"12px"},
					map: map,
					icon: normalIcon()
				  })
				//);
				
				markers[i] = marker;
				//addInfoWindow(marker, "<h3>"+markerData[i].title+"</h3>");
				addInfoWindow(marker, '<div class="item-wrap"><div class="property-item-grid"><figure class="item-thumb"><a href="#" class="hover-effect"><img src="'+markerData[i].image+'" width="290" style="width:290px;" alt="thumb"></a><div class="label-wrap label-left"><span class="label label-success">Featured</span><span class="label label-danger">Open House</span></div><div class="price"><span class="item-price">'+markerData[i].price+'</span><span class="item-sub-price">$21,000/mo</span></div><ul class="actions"><li><span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><i class="fa fa-heart"></i></span></li><li class="share-btn"><div class="share_tooltip fade"><a target="_blank" href="#"><i class="fa fa-facebook"></i></a><a target="_blank" href="#"><i class="fa fa-twitter"></i></a><a target="_blank" href="#"><i class="fa fa-google-plus"></i></a><a target="_blank" href="#"><i class="fa fa-pinterest"></i></a></div><span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span></li><li><span data-toggle="tooltip" data-placement="top" title="Photos (12)"><i class="fa fa-camera"></i></span></li></ul><div class="item-caption"><div class="label-wrap"><span class="label label-primary">For Sale</span></div><h4 class="item-caption-title">Luxury apartment bay view</h4><ul class="item-caption-list"><li>2 bd</li><li>3 ba</li><li>1,287 sqft</li></ul></div></figure></div></div>');
				
				/*var infowindow = new google.maps.InfoWindow({
				  content: "<h3>"+markerData[i].title+"</h3>"
				});
		
				marker.addListener('click', function() {
				  infowindow.open(map, marker);
				});*/
				
				
		
				
				bounds.extend(new google.maps.LatLng(markerData[i].lat, markerData[i].lng));
			  }
			  
			  
			  map.fitBounds(bounds);
			}
			
			
			
			

			// functions that return icons.  Make or find your own markers.
			function normalIcon() {
			  return {
				url: '<?php echo site_url ?>images/pin1.png',
				labelOrigin: new google.maps.Point(25, 12)
			  };
			}
			function highlightedIcon() {
			  return {
				url: '<?php echo site_url ?>images/pin2.png',
				labelOrigin: new google.maps.Point(25, 12)
			  };
			}

    </script>

</body>
</html>