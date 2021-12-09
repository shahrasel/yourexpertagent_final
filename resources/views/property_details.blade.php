@extends('layouts.app')

@section('content')
    @inject('properties', 'App\Models\ResProperties')
    <section id="section-body">

        <!--start detail top-->
        <div class="detail-top detail-top-grid no-margin">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="header-detail table-list">
                            <div class="header-left">
                                <h1>
                                    <?php
                                    echo $property_info['STREETNUM'].' '.$property_info['STREETDIR'].' '.$property_info['STREETNAME'].' '.$property_info['STREETTYPE'] ?>
                                    <span class="label-wrap hidden-sm hidden-xs">
                                        <span class="label label-primary">For Sale</span>
                                        <!--<span class="label label-danger">Sold</span>-->
                                    </span>
                                </h1>
                                <address class="property-address"><?php echo $property_info['CITY'].' '.$property_info['STATE'].' '.$property_info['ZIPCODE'] ?></address>
                            </div>
                            <div class="header-right">
                                <ul class="actions">
                                    <li>

                                    <?php  if(empty($_SESSION['front_user'])): ?>
                                        <a href="#" data-toggle="modal" data-target="#pop-login"><span><i class="fa fa-heart-o"></i></span></a>
                                    <?php else: ?>
                                    <?php
                                    $sql = mysql_query("select id,MLSNUM from bookmarks where user_id='".$_SESSION['front_user']['id']."' and MLSNUM = '".$property_info['MLSNUM']."' limit 1",$connn);
                                    $saved_info = mysql_fetch_assoc ($sql);
                                    ?>
                                        <?php if(!empty($saved_info)): ?>
                                        <a id="remove_fav" onClick="add_remove_fav('<?php echo $_SESSION['front_user']['id'] ?>','<?php echo $property_info['MLSNUM'] ?>','<?php echo $property_info['PROPTYPE'] ?>')"><span><i class="fa fa-heart" style="color: #ff0000"></i></span></a>
                                        <?php else: ?>
                                        <a id="add_fav" onClick="add_remove_fav('<?php echo $_SESSION['front_user']['id'] ?>','<?php echo $property_info['MLSNUM'] ?>','<?php echo $property_info['PROPTYPE'] ?>')"><span><i class="fa fa-heart"></i></span></a>
                                        <?php endif; ?>
                                        <?php endif; ?>

                                    </li>
                                </ul>
                                <span class="item-price">$<?php echo number_format($property_info['LISTPRICE']) ?></span>
                                <?php
                                $interestRate = 3.49;
                                $monthlyInterest = $interestRate/(12*100);

                                $fin_listprice = $property_info['LISTPRICE'] - ($property_info['LISTPRICE']*0.03);
                                $monthlyPayment = ($fin_listprice*$monthlyInterest)/(1- pow((1+$monthlyInterest), -360));


                                $ptax = $property_info['LISTPRICE']*0.018;
                                $pins = $property_info['LISTPRICE']*0.004;
                                $ppmi = $fin_listprice*0.00055;
                                ?>
                                <span class="item-sub-price">$<?php echo number_format($monthlyPayment) ?>/mo</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end detail top-->

        <!--start detail content-->
        <section class="section-detail-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                        <div class="detail-bar">
                            <div class="detail-media detail-top-slideshow">
                                <div class="tab-content">
                                    <div id="map" class="tab-pane fade"></div>
                                    <div id="street-map" class="tab-pane fade"></div>


                                    <div id="gallery" class="tab-pane fade in active">
                                        <span class="label-wrap visible-sm visible-xs">
                                        <span class="label label-primary">For Sale</span>
                                    </span>



                                        <?php if (($property_info['PHOTOCOUNT']) > 0) { ?>
                                        <div class="slideshow">
                                            <div class="slideshow-main">
                                                <div class="slide" style="max-height: 550px;overflow: hidden">
                                                    <?php for($i=1;$i<=$property_info['PHOTOCOUNT'];$i++) { ?>
                                                    <div>
                                                        <img src="<?php echo str_replace('http://matrixrets.ntreis.net/Rets/GetRetsMedia.ashx','http://matrixmedia.ntreis.net/mediaserver/GetMedia.ashx',$property_info['photo'.$i.'_url']) ?>" width="810" height="539" alt="Slide show" >
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="slideshow-nav-main">
                                                <div class="slideshow-nav">
                                                    <?php for($i=1;$i<=$property_info['PHOTOCOUNT'];$i++) { ?>
                                                    <div>
                                                        <img src="<?php echo str_replace('http://matrixrets.ntreis.net/Rets/GetRetsMedia.ashx','http://matrixmedia.ntreis.net/mediaserver/GetMedia.ashx',$property_info['photo'.$i.'_url']) ?>" width="100" height="70" alt="Slide show thumb">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div id="map" class="tab-pane fade"></div>
                                    <div id="street-map" class="tab-pane fade"></div>

                                </div>
                                <div class="media-tabs">
                                    <ul class="media-tabs-list">
                                        <li class="popup-trigger" data-placement="bottom" data-toggle="tooltip" data-original-title="View Photos" style="display: none" id="view_photos">
                                            <a href="#gallery" data-toggle="tab">
                                                <i class="fa fa-camera"></i>
                                            </a>
                                        </li>
                                        <li data-placement="bottom" data-toggle="tooltip" data-original-title="Map View" id="details_icon">
                                            <a href="#map" data-toggle="tab">
                                                <i class="fa fa-map"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="actions">
                                        <li class="share-btn">
                                            <div class="share_tooltip tooltip_left fade">
                                                <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-facebook"></i></a>
                                                <a href="#" onclick="if(!document.getElementById('td_social_networks_buttons')){window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;}"><i class="fa fa-twitter"></i></a>

                                                <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-pinterest"></i></a>

                                                <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-linkedin"></i></a>

                                                <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-google-plus"></i></a>
                                                <a href="#"><i class="fa fa-envelope"></i></a>
                                            </div>
                                            <span data-placement="right" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                        </li>
                                        <li>
                                            <span><i class="fa fa-heart-o"></i></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <div class="detail-list detail-block">
                                <div class="detail-title">
                                    <h2 class="title-left">Property Highlights</h2>
                                </div>
                                <div class="alert alert-info">
                                    <ul class="list-three-col list-features">
                                        <?php if(!empty($property_info['BEDS'])): ?><li><i class="fa fa-check"></i><?php echo $property_info['BEDS'] ?> Beds</li><?php endif; ?>
                                        <?php if(!empty($totalbaths)): ?><li><i class="fa fa-check"></i><?php echo $totalbaths ?> Baths</li><?php endif; ?>
                                        <?php if(!empty($property_info['GARAGECAP'])): ?><li><i class="fa fa-check"></i><?php echo $property_info['GARAGECAP'] ?> Garages</li><?php endif; ?>
                                        <?php if(!empty($property_info['SQFTTOTAL'])): ?><li><i class="fa fa-check"></i><?php echo number_format($property_info['SQFTTOTAL']) ?> Sq Ft</li><?php endif; ?>

                                        <?php if(!empty($property_info['created'])): ?><li><i class="fa fa-check"></i>
                                            <?php if($properties->getDaysBetweenDates(strtotime(date('Y/m/d',strtotime(($property_info['created'])))),strtotime(date('Y/m/d')))>1): echo $properties->getDaysBetweenDates(strtotime(date('Y/m/d',strtotime(($property_info['created'])))),strtotime(date('Y/m/d'))). ' days ago'; else: echo $properties->getDaysBetweenDates(strtotime(date('Y/m/d',strtotime(($property_info['created'])))),strtotime(date('Y/m/d'))). ' day ago'; endif; ?>
                                        </li><?php endif; ?>
                                        <?php if(!empty($property_info['LISTSTATUS'])): ?><li><i class="fa fa-check"></i><?php echo $property_info['LISTSTATUS']; ?></li><?php endif; ?>
                                        <?php if(!empty($property_info['YEARBUILT'])): ?><li><i class="fa fa-check"></i>Built in <?php echo $property_info['YEARBUILT'] ?></li><?php endif; ?>
                                        <?php if(!empty($property_info['LotSizeArea'])): ?><li><i class="fa fa-check"></i><?php echo $property_info['LotSizeArea'] ?> <?php echo (($property_info['LotSizeArea']>1)?'Acres':'Acre') ?></li><?php endif; ?>
                                    </ul>
                                </div>

                                <?php if(!empty($property_info['REMARKS'])): ?>
                                <p>
                                    <?php echo $property_info['REMARKS'] ?>
                                </p>
                                <?php endif; ?>
                            </div>



                            <div class="detail-address detail-block">
                                <div class="detail-title">
                                    <h2 class="title-left">Detailed Information</h2>
                                    <div class="title-right">                                        &nbsp;
                                    </div>
                                </div>
                                <ul class="list-two-col">
                                    <li><strong>MLS: #</strong> <?php echo $property_info['MLSNUM'] ?></li>
                                    <li><strong>Type:</strong> <?php echo $property_info['PROPSUBTYPE']; ?></li>
                                    <?php if(!empty($property_info['AREATITLE'])): ?>
                                    <li><strong>Area:</strong> <?php echo $property_info['AREATITLE']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['STYLE'])): ?>
                                    <li><strong>Style:</strong> <?php echo $property_info['STYLE']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['STORIES'])): ?>
                                    <li><strong>Stories:</strong> <?php echo $property_info['STORIES']; ?></li>
                                    <?php endif; ?>


                                    <?php if (!empty($property_info['FOUNDATION'])): ?>
                                    <li><strong>Foundation:</strong> <?php echo $property_info['FOUNDATION']; ?></li>
                                    <?php endif; ?>


                                    <?php if (!empty($property_info['EXTERIOR'])): ?>
                                    <li><strong>Exterior:</strong> <?php echo $property_info['EXTERIOR']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['INTERIOR'])): ?>
                                    <li><strong>Interior:</strong> <?php echo $property_info['INTERIOR']; ?></li>
                                    <?php endif; ?>

                                    <?php if(!empty($property_info['Heating'])): ?>
                                    <li><strong>Heating:</strong> <?php echo $property_info['Heating']; ?></li>
                                    <?php endif; ?>

                                    <?php if(!empty($property_info['ConstructionMaterials'])): ?>
                                    <li><strong>Construction Material:</strong> <?php echo $property_info['ConstructionMaterials']; ?></li>
                                    <?php endif; ?>


                                    <?php if(!empty($property_info['Flooring'])): ?>
                                    <li><strong>Flooring:</strong> <?php echo $property_info['Flooring']; ?></li>
                                    <?php endif; ?>



                                    <?php if (!empty($property_info['FENCE'])): ?>
                                    <li><strong>Fence:</strong> <?php echo $property_info['FENCE']; ?></li>
                                    <?php endif; ?>


                                        <?php if (!empty($property_info['POOLYN'])): ?>
                                        <li><strong>Pool:</strong> <?php echo $property_info['POOLYN']; ?></li>
                                        <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMKITCHENDESC'])): ?>
                                    <li><strong>Kitchen Equipment:</strong> <?php echo $property_info['ROOMKITCHENDESC']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMBEDBATHDESC'])): ?>
                                    <li><strong>Bed Bath Description.:</strong> <?php echo $property_info['ROOMBEDBATHDESC']; ?></li>
                                    <?php endif; ?>


                                    <?php if (!empty($property_info['GARAGEDESC'])): ?>
                                    <li><strong>Parking/Garage Description:</strong> <?php echo $property_info['GARAGEDESC']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMUTILDESC'])): ?>
                                    <li><strong>Utility:</strong> <?php echo $property_info['ROOMUTILDESC']; ?></li>
                                    <?php endif; ?>






                                    <?php if (!empty($property_info['COMMONFEATURES'])): ?>
                                    <li><strong>Common Features:</strong> <?php echo $property_info['COMMONFEATURES']; ?></li>
                                    <?php endif; ?>



                                    <?php if (!empty($property_info['CONSTRUCTION'])): ?>
                                    <li><strong>Construction:</strong> <?php echo $property_info['CONSTRUCTION']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['LOTDESC'])): ?>
                                    <li><strong>Lot Description:</strong> <?php echo $property_info['LOTDESC']; ?></li>
                                    <?php endif; ?>


                                    <?php if (!empty($property_info['ROOF'])): ?>
                                    <li><strong>Roof:</strong> <?php echo $property_info['ROOF']; ?></li>
                                    <?php endif; ?>











                                    <?php if (!empty($property_info['AssociationType'])): ?>
                                    <li><strong>Association Type:</strong> <?php echo $property_info['AssociationType']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['AssociationFee'])): ?>
                                    <li><strong>Association Fee:</strong> <?php echo '$'.$property_info['AssociationFee'].'/'.$property_info['AssociationFeeFrequency']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['AssociationFeeIncludes'])): ?>
                                    <li><strong>Association Fee Includes:</strong> <?php echo $property_info['AssociationFeeIncludes']; ?></li>
                                    <?php endif; ?>


                                    <li><strong>Status:</strong> <?php echo $property_info['LISTSTATUS']; ?></li>
                                </ul>
                            </div>


                            <div class="detail-address detail-block">
                                <div class="detail-title">
                                    <h2 class="title-left">Room Information</h2>
                                    <div class="title-right">
                                        &nbsp;
                                    </div>
                                </div>
                                <ul class="list-two-col">

                                    <?php if (!empty($property_info['ROOMLIVING1LENGTH'])): ?>
                                    <li><strong>Living 1:</strong> <?php echo $property_info['ROOMLIVING1LENGTH'] . " X " . $property_info['ROOMLIVING1WIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMLIVING2LENGTH'])): ?>
                                    <li><strong>Living 2:</strong> <?php echo $property_info['ROOMLIVING2LENGTH'] . " X " . $property_info['ROOMLIVING2WIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMOTHER1LENGTH'])): ?>
                                    <li><strong>Den:</strong> <?php echo $property_info['ROOMOTHER1LENGTH'] . " X " . $property_info['ROOMOTHER1WIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMMASTERBEDLENGTH'])): ?>
                                    <li><strong>Master:</strong> <?php echo $property_info['ROOMMASTERBEDLENGTH'] . " X " . $property_info['ROOMMASTERBEDWIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMBED2WIDTH'])): ?>
                                    <li><strong>Bedroom 2:</strong> <?php echo $property_info['ROOMBED2WIDTH'] . " X " . $property_info['ROOMBED2WIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMBED3LENGTH'])): ?>
                                    <li><strong>Bedroom 2:</strong> <?php echo $property_info['ROOMBED3LENGTH'] . " X " . $property_info['ROOMBED3WIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMBED4LENGTH'])): ?>
                                    <li><strong>Living 1:</strong> <?php echo $property_info['ROOMBED4LENGTH'] . " X " . $property_info['ROOMBED4WIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMDININGLENGTH'])): ?>
                                    <li><strong>Dining:</strong> <?php echo $property_info['ROOMDININGLENGTH'] . " X " . $property_info['ROOMDININGWIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMKITCHENLENGTH'])): ?>
                                    <li><strong>Kitchen:</strong> <?php echo $property_info['ROOMKITCHENLENGTH'] . " X " . $property_info['ROOMKITCHENWIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMBREAKFASTLENGTH'])): ?>
                                    <li><strong>Breakfast:</strong> <?php echo $property_info['ROOMBREAKFASTLENGTH'] . " X " . $property_info['ROOMBREAKFASTWIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMSTUDYLENGTH'])): ?>
                                    <li><strong>Study:</strong> <?php echo $property_info['ROOMSTUDYLENGTH'] . " X " . $property_info['ROOMSTUDYWIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMGARAGELENGTH'])): ?>
                                    <li><strong>Garage:</strong> <?php echo $property_info['ROOMGARAGELENGTH'] . " X " . $property_info['ROOMGARAGEWIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMUTILITYLENGTH'])): ?>
                                    <li><strong>Utility Rooms:</strong> <?php echo $property_info['ROOMUTILITYLENGTH'] . " X " . $property_info['ROOMUTILITYWIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMOTHER1LENGTH'])): ?>
                                    <li><strong>Other Room:</strong> <?php echo $property_info['ROOMOTHER1LENGTH'] . " X " . $property_info['ROOMOTHER1WIDTH']; ?></li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMFULLBATHLENGTH'])): ?>
                                    <li><strong>Full Bath:</strong> <?php echo $property_info['ROOMFULLBATHLENGTH'] . " X " . $property_info['ROOMFULLBATHWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMHALFBATHLENGTH'])): ?>
                                    <li><strong>Half Bath:</strong> <?php echo $property_info['ROOMHALFBATHLENGTH'] . " X " . $property_info['ROOMHALFBATHWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMEXERCISELENGTH'])): ?>
                                    <li><strong>Exercise:</strong> <?php echo $property_info['ROOMEXERCISELENGTH'] . " X " . $property_info['ROOMEXERCISEWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSTORAGELENGTH'])): ?>
                                    <li><strong>Study:</strong> <?php echo $property_info['ROOMSTORAGELENGTH'] . " X " . $property_info['ROOMSTORAGEWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMGAMELENGTH'])): ?>
                                    <li><strong>Study:</strong> <?php echo $property_info['ROOMGAMELENGTH'] . " X " . $property_info['ROOMGAMEWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMGUESTLENGTH'])): ?>
                                    <li><strong>Study:</strong> <?php echo $property_info['ROOMGUESTLENGTH'] . " X " . $property_info['ROOMGUESTWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMLIBRARYLENGTH'])): ?>
                                    <li><strong>library_room:</strong> <?php echo $property_info['ROOMLIBRARYLENGTH'] . " X " . $property_info['ROOMLIBRARYWIDTH']; ?></li>
                                    <?php endif; ?>


                                    <?php if (!empty($property_info['ROOMMEDIALENGTH'])): ?>
                                    <li><strong>media_room:</strong> <?php echo $property_info['ROOMMEDIALENGTH'] . " X " . $property_info['ROOMMEDIAWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMMUDLENGTH'])): ?>
                                    <li><strong>mud_room:</strong> <?php echo $property_info['ROOMMUDLENGTH'] . " X " . $property_info['ROOMMUDWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMOFFICELENGTH'])): ?>
                                    <li><strong>office_room:</strong> <?php echo $property_info['ROOMOFFICELENGTH'] . " X " . $property_info['ROOMOFFICEWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSAUNALENGTH'])): ?>
                                    <li><strong>sauna_room:</strong> <?php echo $property_info['ROOMSAUNALENGTH'] . " X " . $property_info['ROOMMEDIAWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSECONDMASTERLENGTH'])): ?>
                                    <li><strong>second_master_room:</strong> <?php echo $property_info['ROOMSECONDMASTERLENGTH'] . " X " . $property_info['ROOMSECONDMASTERWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSUNLENGTH'])): ?>
                                    <li><strong>sun_room:</strong> <?php echo $property_info['ROOMSUNLENGTH'] . " X " . $property_info['ROOMSUNWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSAUNALENGTH'])): ?>
                                    <li><strong>sauna_room:</strong> <?php echo $property_info['ROOMSAUNALENGTH'] . " X " . $property_info['ROOMSAUNAWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSPALENGTH'])): ?>
                                    <li><strong>spa_room:</strong> <?php echo $property_info['ROOMSPALENGTH'] . " X " . $property_info['ROOMSPAWIDTH']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMWINELENGTH'])): ?>
                                    <li><strong>wine_room:</strong> <?php echo $property_info['ROOMWINELENGTH'] . " X " . $property_info['ROOMWINEWIDTH']; ?></li>
                                    <?php endif; ?>
                                </ul>
                            </div>



                            <div class="detail-address detail-block">
                                <div class="detail-title">
                                    <h2 class="title-left">Room Features</h2>
                                    <div class="title-right">
                                        &nbsp;
                                    </div>
                                </div>
                                <ul class="list-two-col">
                                    <?php if (!empty($property_info['living_room_feature'])): ?>
                                    <li><strong>Living Room Feature:</strong> <?php echo $property_info['living_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['master_bed_room_feature'])): ?>
                                    <li><strong>Master Bed Room Feature:</strong> <?php echo $property_info['master_bed_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['bed_room_feature'])): ?>
                                    <li><strong>Bed Room Feature:</strong> <?php echo $property_info['bed_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['dining_room_feature'])): ?>
                                    <li><strong>Dining Room Feature:</strong> <?php echo $property_info['dining_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['kitchen_room_feature'])): ?>
                                    <li><strong>Kitchen Room Feature:</strong> <?php echo $property_info['kitchen_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['breakfast_room_feature'])): ?>
                                    <li><strong>Breakfast Room Feature:</strong> <?php echo $property_info['breakfast_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['study_room_feature'])): ?>
                                    <li><strong>Study Room Feature:</strong> <?php echo $property_info['study_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['utility_room_feature'])): ?>
                                    <li><strong>Utility Room Feature:</strong> <?php echo $property_info['utility_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['full_bath_room_feature'])): ?>
                                    <li><strong>Full Bathroom Feature:</strong> <?php echo $property_info['full_bath_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['half_bath_room_feature'])): ?>
                                    <li><strong>Half Bathroom Feature:</strong> <?php echo $property_info['half_bath_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['other_room_feature'])): ?>
                                    <li><strong>Other Room Feature:</strong> <?php echo $property_info['other_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['exercise_room_feature'])): ?>
                                    <li><strong>Exercise Room Feature:</strong> <?php echo $property_info['exercise_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['extra_storage_room_feature'])): ?>
                                    <li><strong>Extra Storage Room Feature:</strong> <?php echo $property_info['extra_storage_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['game_room_feature'])): ?>
                                    <li><strong>Game Room Feature:</strong> <?php echo $property_info['game_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['guest_room_feature'])): ?>
                                    <li><strong>Guest Room Feature:</strong> <?php echo $property_info['guest_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['library_room_feature'])): ?>
                                    <li><strong>Library Room Feature:</strong> <?php echo $property_info['library_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['media_room_feature'])): ?>
                                    <li><strong>Media Room Feature:</strong> <?php echo $property_info['media_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['mud_room_feature'])): ?>
                                    <li><strong>Mud Room Feature:</strong> <?php echo $property_info['mud_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['office_room_feature'])): ?>
                                    <li><strong>Office Room Feature:</strong> <?php echo $property_info['office_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['sauna_room_feature'])): ?>
                                    <li><strong>Sauna Room Feature:</strong> <?php echo $property_info['sauna_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['second_master_room_feature'])): ?>
                                    <li><strong>Second Master Room Feature:</strong> <?php echo $property_info['second_master_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['sunroom_room_feature'])): ?>
                                    <li><strong>Sunroom Room Feature:</strong> <?php echo $property_info['sunroom_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['spa_room_feature'])): ?>
                                    <li><strong>Spa Room Feature:</strong> <?php echo $property_info['spa_room_feature']; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['wine_room_feature'])): ?>
                                    <li><strong>Wine Room Feature:</strong> <?php echo $property_info['wine_room_feature']; ?></li>
                                    <?php endif;  ?>
                                </ul>
                            </div>

                            <div class="detail-address detail-block">
                                <div class="detail-title">
                                    <h2 class="title-left">Location & Schools</h2>
                                    <div class="title-right">
                                        <!--<a href="#">Open on Google Maps <i class="fa fa-map-marker"></i></a>-->
                                        &nbsp;
                                    </div>
                                </div>
                                <ul class="list-two-col">
                                    <li><strong>City:</strong> <?php echo $property_info['CITY'] ?></li>
                                    <li><strong>State:</strong> <?php echo $property_info['STATE']; ?></li>
                                    <?php if(!empty($property_info['SUBDIVISION'])): ?>
                                    <li><strong>Subdivision:</strong> <?php echo $property_info['SUBDIVISION']; ?></li>
                                    <?php endif; ?>
                                    <li><strong>School District:</strong> <?php echo $property_info['SCHOOLDISTRICT']; ?></li>
                                    <?php if(!empty($property_info['SCHOOLNAME1'])): ?>
                                    <li><strong>Elementary School:</strong> <?php echo ucwords(strtolower($property_info['SCHOOLNAME1'])); ?></li>
                                    <?php endif; ?>

                                    <?php if(!empty($property_info['SCHOOLNAME2'])): ?>
                                    <li><strong>Middle School:</strong> <?php echo ucwords(strtolower($property_info['SCHOOLNAME2'])); ?></li>
                                    <?php endif; ?>

                                    <?php if(!empty($property_info['SCHOOLNAME3'])): ?>
                                    <li><strong>High School:</strong> <?php echo ucwords(strtolower($property_info['SCHOOLNAME3'])); ?></li>
                                    <?php endif; ?>

                                    <?php if(!empty($property_info['JuniorHighSchoolName'])): ?>
                                    <li><strong>Junior High School:</strong> <?php echo ucwords(strtolower($property_info['JuniorHighSchoolName'])); ?></li><?php endif; ?>
                                    <?php if(!empty($property_info['PrimarySchoolName'])): ?>
                                    <li><strong>Primary School:</strong> <?php echo ucwords(strtolower($property_info['PrimarySchoolName'])); ?></li>
                                    <?php endif; ?>

                                    <?php if(!empty($property_info['SeniorHighSchoolName'])): ?>
                                    <li><strong>Senior High School:</strong> <?php echo ucwords(strtolower($property_info['SeniorHighSchoolName'])); ?></li><?php endif; ?>
                                </ul>
                            </div>



                            <div class="detail-address detail-block">
                                <div class="detail-title">
                                    <h2 class="title-left">Listing Agency</h2>
                                    <div class="title-right">
                                        &nbsp;
                                    </div>
                                </div>
                                <ul class="list-two-col">
                                    <?php if(!empty($property_info['OFFICESELL_OFFICENAM2'])): ?>
                                    <li><?php echo $property_info['OFFICESELL_OFFICENAM2']; ?></li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
                        <aside id="sidebar">
                            <?php if(!empty($similarLists)): ?>
                            <div class="widget widget-recommend">
                                <div class="widget-top">
                                    <h3 class="widget-title">Similar Properties</h3>
                                </div>
                                <div class="widget-body">
                                    <?php if(!empty($similarLists)): ?>
                                    <?php foreach($similarLists as $similarList): ?>
                                    <?php
                                    $sim_list_addr = $similarList['STREETNUM'].' '.$similarList['STREETDIR'].' '.$similarList['STREETNAME'].' '.$similarList['STREETTYPE'].'<br/>'.$similarList['CITY'].' '.$similarList['STATE'].' '.$similarList['ZIPCODE'];

                                    $sim_fin_bath_room = '';
                                    $sim_totalbaths = '';
                                    if(!empty($similarList['BATHSFULL']))
                                        $sim_fin_bath_room .= $similarList['BATHSFULL'];
                                    if(!empty($similarList['BATHSHALF']))
                                        $sim_fin_bath_room .= '.'.$similarList['BATHSHALF'];


                                    if(!empty($similarList['BATHSTOTAL'])):
                                        $sim_totalbaths = $similarList['BATHSTOTAL'];
                                    else:
                                        $sim_totalbaths = $sim_fin_bath_room;
                                    endif;
                                    ?>

                                    <div class="media">
                                        <div class="media-left">
                                            <figure class="item-thumb">
                                                <a href="<?php echo site_url.'property_details/'.$similarList['permalink'] ?>/<?php if(!empty($_REQUEST['sel_lender'])): echo $_REQUEST['sel_lender']; endif; ?>">

                                                    <?php if(!empty($similarList['PHOTO_URL']) && $similarList['PHOTOCOUNT']>1): ?>
                                                    <img src="<?php echo str_replace('http://matrixrets.ntreis.net/Rets/GetRetsMedia.ashx','http://matrixmedia.ntreis.net/mediaserver/GetMedia.ashx',$similarList['photo1_url']) ?>" width="100" height="75">
                                                    <?php else: ?>
                                                    <img src="<?php echo site_url ?>images/greenhome.jpg" alt=""  width="100" height="75" />
                                                    <?php endif; ?>
                                                </a>
                                            </figure>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading"><a href="<?php echo site_url.'property_details/'.$similarList['permalink'] ?>/<?php if(!empty($_REQUEST['sel_lender'])): echo $_REQUEST['sel_lender']; endif; ?>"><?php echo $sim_list_addr ?></a></h3>




                                            <h4><?php echo strstr(money_format('%n', $similarList['LISTPRICE']),'.',true) ?></h4>
                                            <div class="amenities">
                                                <p><?php echo $similarList['BEDS'] ?> beds • <?php echo $sim_totalbaths ?> baths • <?php echo number_format($similarList['SQFTTOTAL']) ?> sqft • <?php echo $similarList['GARAGECAP'] ?> garages</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endif; ?>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!--end detail content-->

    </section>
@endsection
