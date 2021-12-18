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
                                        <span class="label label-danger">For Sale</span>
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
                                {{--<span class="item-sub-price">$<?php echo number_format($monthlyPayment) ?>/mo</span>--}}
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
                                    <div id="map" class="tab-pane fade" style="max-height: 550px"></div>
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
                                    {{--<ul class="media-tabs-list">
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
                                    </ul>--}}
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
                                    <li><strong>Living 1:</strong> <?php echo $property_info['ROOMLIVING1LENGTH'] . " X " . $property_info['ROOMLIVING1WIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMLIVING2LENGTH'])): ?>
                                    <li><strong>Living 2:</strong> <?php echo $property_info['ROOMLIVING2LENGTH'] . " X " . $property_info['ROOMLIVING2WIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMOTHER1LENGTH'])): ?>
                                    <li><strong>Den:</strong> <?php echo $property_info['ROOMOTHER1LENGTH'] . " X " . $property_info['ROOMOTHER1WIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMMASTERBEDLENGTH'])): ?>
                                    <li><strong>Master:</strong> <?php echo $property_info['ROOMMASTERBEDLENGTH'] . " X " . $property_info['ROOMMASTERBEDWIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMBED2WIDTH'])): ?>
                                    <li><strong>Bedroom 2:</strong> <?php echo $property_info['ROOMBED2WIDTH'] . " X " . $property_info['ROOMBED2WIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMBED3LENGTH'])): ?>
                                    <li><strong>Bedroom 2:</strong> <?php echo $property_info['ROOMBED3LENGTH'] . " X " . $property_info['ROOMBED3WIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMBED4LENGTH'])): ?>
                                    <li><strong>Living 1:</strong> <?php echo $property_info['ROOMBED4LENGTH'] . " X " . $property_info['ROOMBED4WIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMDININGLENGTH'])): ?>
                                    <li><strong>Dining:</strong> <?php echo $property_info['ROOMDININGLENGTH'] . " X " . $property_info['ROOMDININGWIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMKITCHENLENGTH'])): ?>
                                    <li><strong>Kitchen:</strong> <?php echo $property_info['ROOMKITCHENLENGTH'] . " X " . $property_info['ROOMKITCHENWIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMBREAKFASTLENGTH'])): ?>
                                    <li><strong>Breakfast:</strong> <?php echo $property_info['ROOMBREAKFASTLENGTH'] . " X " . $property_info['ROOMBREAKFASTWIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMSTUDYLENGTH'])): ?>
                                    <li><strong>Study:</strong> <?php echo $property_info['ROOMSTUDYLENGTH'] . " X " . $property_info['ROOMSTUDYWIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMGARAGELENGTH'])): ?>
                                    <li><strong>Garage:</strong> <?php echo $property_info['ROOMGARAGELENGTH'] . " X " . $property_info['ROOMGARAGEWIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMUTILITYLENGTH'])): ?>
                                    <li><strong>Utility Rooms:</strong> <?php echo $property_info['ROOMUTILITYLENGTH'] . " X " . $property_info['ROOMUTILITYWIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMOTHER1LENGTH'])): ?>
                                    <li><strong>Other Room:</strong> <?php echo $property_info['ROOMOTHER1LENGTH'] . " X " . $property_info['ROOMOTHER1WIDTH']; ?> ft</li>
                                    <?php endif; ?>

                                    <?php if (!empty($property_info['ROOMFULLBATHLENGTH'])): ?>
                                    <li><strong>Full Bath:</strong> <?php echo $property_info['ROOMFULLBATHLENGTH'] . " X " . $property_info['ROOMFULLBATHWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMHALFBATHLENGTH'])): ?>
                                    <li><strong>Half Bath:</strong> <?php echo $property_info['ROOMHALFBATHLENGTH'] . " X " . $property_info['ROOMHALFBATHWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMEXERCISELENGTH'])): ?>
                                    <li><strong>Exercise:</strong> <?php echo $property_info['ROOMEXERCISELENGTH'] . " X " . $property_info['ROOMEXERCISEWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSTORAGELENGTH'])): ?>
                                    <li><strong>Study:</strong> <?php echo $property_info['ROOMSTORAGELENGTH'] . " X " . $property_info['ROOMSTORAGEWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMGAMELENGTH'])): ?>
                                    <li><strong>Study:</strong> <?php echo $property_info['ROOMGAMELENGTH'] . " X " . $property_info['ROOMGAMEWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMGUESTLENGTH'])): ?>
                                    <li><strong>Study:</strong> <?php echo $property_info['ROOMGUESTLENGTH'] . " X " . $property_info['ROOMGUESTWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMLIBRARYLENGTH'])): ?>
                                    <li><strong>library_room:</strong> <?php echo $property_info['ROOMLIBRARYLENGTH'] . " X " . $property_info['ROOMLIBRARYWIDTH']; ?> ft</li>
                                    <?php endif; ?>


                                    <?php if (!empty($property_info['ROOMMEDIALENGTH'])): ?>
                                    <li><strong>media_room:</strong> <?php echo $property_info['ROOMMEDIALENGTH'] . " X " . $property_info['ROOMMEDIAWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMMUDLENGTH'])): ?>
                                    <li><strong>mud_room:</strong> <?php echo $property_info['ROOMMUDLENGTH'] . " X " . $property_info['ROOMMUDWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMOFFICELENGTH'])): ?>
                                    <li><strong>office_room:</strong> <?php echo $property_info['ROOMOFFICELENGTH'] . " X " . $property_info['ROOMOFFICEWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSAUNALENGTH'])): ?>
                                    <li><strong>sauna_room:</strong> <?php echo $property_info['ROOMSAUNALENGTH'] . " X " . $property_info['ROOMMEDIAWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSECONDMASTERLENGTH'])): ?>
                                    <li><strong>second_master_room:</strong> <?php echo $property_info['ROOMSECONDMASTERLENGTH'] . " X " . $property_info['ROOMSECONDMASTERWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSUNLENGTH'])): ?>
                                    <li><strong>sun_room:</strong> <?php echo $property_info['ROOMSUNLENGTH'] . " X " . $property_info['ROOMSUNWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSAUNALENGTH'])): ?>
                                    <li><strong>sauna_room:</strong> <?php echo $property_info['ROOMSAUNALENGTH'] . " X " . $property_info['ROOMSAUNAWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMSPALENGTH'])): ?>
                                    <li><strong>spa_room:</strong> <?php echo $property_info['ROOMSPALENGTH'] . " X " . $property_info['ROOMSPAWIDTH']; ?> ft</li>
                                    <?php endif; ?>
                                    <?php if (!empty($property_info['ROOMWINELENGTH'])): ?>
                                    <li><strong>wine_room:</strong> <?php echo $property_info['ROOMWINELENGTH'] . " X " . $property_info['ROOMWINEWIDTH']; ?> ft</li>
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
                                                <a href="{{ url('/') }}/property_details/<?php echo $similarList['permalink'] ?>/residential">

                                                    <?php if(!empty($similarList['PHOTO_URL']) && $similarList['PHOTOCOUNT']>1): ?>
                                                    <img src="<?php echo str_replace('http://matrixrets.ntreis.net/Rets/GetRetsMedia.ashx','http://matrixmedia.ntreis.net/mediaserver/GetMedia.ashx',$similarList['photo1_url']) ?>" width="100" height="75">
                                                    <?php else: ?>
                                                    <img src="{{ url('/') }}/images/greenhome.jpg" alt=""  width="100" height="75" />
                                                    <?php endif; ?>
                                                </a>
                                            </figure>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading"><a href="{{ url('/') }}/property_details/<?php echo $similarList['permalink'] ?>/residential"><?php echo $sim_list_addr ?></a></h3>




                                            <h4><?php echo '$'.number_format($similarList['LISTPRICE']) ?></h4>
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
                <div class="detail-address detail-block" style="margin-top: 40px;">
                    <div class="detail-title">
                        <h2 class="title-left">Area Information</h2>
                        <div class="title-right">
                            &nbsp;
                        </div>
                    </div>

                    <h2>Detailed Crime Report of <?php echo $property_info['CITY'] ?> in 2019</h2>
                    <br/>
                    <ul class="list-four-col list-features">
                        <li><i class="fa fa-check"></i> Total: {{ number_format($crime_report->population) }} Resident</li>
                        <li><i class="fa fa-check"></i> {{ number_format($crime_report->violent_crime) }} Violent Crime</li>
                        <li><i class="fa fa-check"></i> {{ number_format($crime_report->murder) }} Murder</li>
                        <li><i class="fa fa-check"></i> {{ number_format($crime_report->rape) }} Rape</li>
                        <li><i class="fa fa-check"></i> {{ number_format($crime_report->robbery) }} Robbery</li>
                        <li><i class="fa fa-check"></i> {{ number_format($crime_report->aggravated_assault) }} Aggravated Assault</li>
                        <li><i class="fa fa-check"></i> {{ number_format($crime_report->property_crime) }} Property Crime</li>
                        <li><i class="fa fa-check"></i> {{ number_format($crime_report->burglary) }} Burglary</li>
                        <li><i class="fa fa-check"></i> {{ number_format($crime_report->larceny) }} Larceny</li>
                        <li><i class="fa fa-check"></i> {{ number_format($crime_report->vehicle_theft) }} Vehicle Theft</li>
                    </ul>
                    <br/>

                    <div id="loading_div">
                        <div>
                            <img src="{{ asset('images/loading.gif') }}" style="width: 35px">
                        </div>
                        <div id="loading_staus"></div>
                    </div>

                    <br/>
                    <h2>Nearby amenities of this property</h2>
                    <ul class="list-four-col list-features" id="final_loading_status_div">
                    </ul><br/><br/>

                    <div id="map2" style="border: 1px solid #000;height: 550px">
                        &nbsp;
                    </div>


                </div>
            </div>
        </section>
        <!--end detail content-->

    </section>
@endsection
@php
    if(auth()->user()->profession=='Student') {
        //echo 'student';
        $arr = ["bank", "bar","book_store", "cafe", "clothing_store", "movie_theater","night_club", "park", "restaurant", "shopping_mall","stadium", "supermarket","tourist_attraction", "university"];
    }
    else if(auth()->user()->have_children =='Yes') {
        if(auth()->user()->age>65) {
            //echo 'children+old';
            $arr = ["bank", "book_store", "cafe", "clothing_store", "department_store", "drugstore", "hospital","jewelry_store","movie_theater","park", "pharmacy","restaurant", "shopping_mall","supermarket","tourist_attraction"];
        }
        else {
            //echo 'children not old';
            $arr = ["bank", "bar","book_store", "cafe", "clothing_store", "department_store", "drugstore", "hospital","jewelry_store","movie_theater","night_club", "park", "pharmacy","primary_school", "restaurant","secondary_school", "shopping_mall","stadium", "supermarket","tourist_attraction", "university"];
        }
    }
    else if(auth()->user()->age>65) {
        //echo 'old';
        $arr = ["bank", "book_store", "cafe", "clothing_store", "department_store", "drugstore", "hospital","jewelry_store","movie_theater","park", "pharmacy","restaurant", "shopping_mall","supermarket","tourist_attraction"];
    }
    else if((auth()->user()->age>23 && auth()->user()->age<45) && (auth()->user()->profession =='Teacher')) { //young professional but teacher
        //echo 'young teacher';
        $arr = ["bank", "bar","book_store", "cafe", "clothing_store", "department_store", "drugstore", "hospital","jewelry_store","movie_theater","night_club", "park", "pharmacy", "restaurant", "shopping_mall","stadium", "supermarket","tourist_attraction","primary_school", "secondary_school", "university"];
    }
    else if((auth()->user()->age>23 && auth()->user()->age<45) && (auth()->user()->profession !='Teacher')) { //young professional but not students do not need schools
        //echo 'young not teacher';
        $arr = ["bank", "bar","book_store", "cafe", "clothing_store", "department_store", "drugstore", "hospital","jewelry_store","movie_theater","night_club", "park", "pharmacy", "restaurant", "shopping_mall","stadium", "supermarket","tourist_attraction"];
    }
    else if((auth()->user()->age>45 && auth()->user()->age<65) && (auth()->user()->profession =='Teacher')) { //professional without children do not need school or university
        //echo 's young teacher';
        $arr = ["bank", "bar","book_store", "cafe", "clothing_store", "department_store", "drugstore", "hospital","jewelry_store","movie_theater","night_club", "park", "pharmacy", "restaurant","shopping_mall","stadium", "supermarket","tourist_attraction","primary_school", "secondary_school", "university"];
    }
    else if((auth()->user()->age>45 && auth()->user()->age<65) && (auth()->user()->profession !='Teacher')) { //professional without children do not need school or university
        //echo 's young not teacher';
        $arr = ["bank", "bar","book_store", "cafe", "clothing_store", "department_store", "drugstore", "hospital","jewelry_store","movie_theater","night_club", "park", "pharmacy", "restaurant","shopping_mall","stadium", "supermarket","tourist_attraction"];
    }
    /*print_r($arr);
    exit;*/


    /*$arr = ["bank", "bar","book_store", "cafe", "clothing_store", "department_store", "drugstore", "hospital","jewelry_store","movie_theater","night_club", "park", "pharmacy","primary_school", "restaurant","secondary_school", "shopping_mall","stadium", "supermarket","tourist_attraction", "university"];*/
@endphp

@section('javascript')
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyAFqAPWaxVQnJMkCBEHvlP1fIqevvgoN44"
            type="text/javascript"></script>

    <script type="text/javascript">
        var map = null;
        var panorama = null;
        var fenway = new google.maps.LatLng('<?php echo $property_info['LATITUDE'] ?>', '<?php echo $property_info['LONGITUDE'] ?>');
        var mapOptions = {
            center: fenway,
            zoom: 14
        };
        var panoramaOptions = {
            position: fenway,
            pov: {
                heading: 34,
                pitch: 10
            }
        };
        var tabsHeight = function() {
            jQuery("#map,#street-map").css('min-height',jQuery(".detail-media #gallery").innerHeight());
        };

        jQuery(window).on('load',function(){
            tabsHeight();
        });
        jQuery(window).on('resize',function(){
            tabsHeight();
        });
        /*function initialize() {

            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            panorama = new google.maps.StreetViewPanorama(document.getElementById('street-map'), panoramaOptions);
            map.setStreetView(panorama);

            var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
            var beachMarker = new google.maps.Marker({
                position: {lat: <?php echo $property_info['LATITUDE'] ?>, lng: <?php echo $property_info['LONGITUDE'] ?>},
                map: map,
                //icon: image
            });
        }*/

        jQuery('a[href="#gallery"]').on('shown.bs.tab', function (e) {
            jQuery("#view_photos").css('display','none');
            jQuery("#details_icon").css('display','block');
        });

        jQuery('a[href="#map"]').on('shown.bs.tab', function (e) {
            jQuery("#view_photos").css('display','block');
            jQuery("#details_icon").css('display','none');
            var center = panorama.getPosition();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
        jQuery('a[href="#street-map"]').on('shown.bs.tab', function (e) {

            jQuery("#view_photos").css('display','none');
            jQuery("#details_icon").css('display','block');

            fenway = panorama.getPosition();
            panoramaOptions.position = fenway;
            panorama = new google.maps.StreetViewPanorama(document.getElementById('street-map'), panoramaOptions);
            map.setStreetView(panorama);
        });
        //google.maps.event.addDomListener(window, 'load', initialize);
        jQuery(document).ready(function() {
            //initialize();

            const styles = {
                default: [],
                hide: [
                    {
                        featureType: "poi.business",
                        stylers: [{ visibility: "off" }],
                    },
                    {
                        featureType: "transit",
                        elementType: "labels.icon",
                        stylers: [{ visibility: "off" }],
                    },
                ],
            };

            var map = new google.maps.Map(document.getElementById('map2'), {
                zoom: 12,
                center: new google.maps.LatLng(<?php echo $property_info['LATITUDE'] ?>,<?php echo $property_info['LONGITUDE'] ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: styles["hide"]
            });

            var beachMarker = new google.maps.Marker({
                position: {lat: <?php echo $property_info['LATITUDE'] ?>, lng: <?php echo $property_info['LONGITUDE'] ?>},
                map: map,
            });

            var infowindow = new google.maps.InfoWindow();
            var marker, i;






            var y=0;
            localStorage.setItem('test', y);
            <?php echo "var javascript_array = ". json_encode($arr) . ";\n"; ?>
            const myInterval = setInterval(function(){jQuery("#loading_div").css('display','block');get_fb(javascript_array,localStorage.getItem('test')); y++; parseInt(localStorage.setItem('test', y))}, 2000);

            function get_fb(arr,a) {
                if(arr[a]) {
                    jQuery("#loading_staus").html("Loading "+arr[a]+" ...");
                    $.get("{{ url('/') }}/get-gmp-amenities?amenity=" + arr[a]+"&latitude=<?php echo $property_info['LATITUDE'] ?>&longitude=<?php echo $property_info['LONGITUDE'] ?>", function (data, status) {
                        if(data) {
                            var locations = JSON.parse(data);

                            jQuery("#final_loading_status_div").append('<li><i class="fa fa-check"></i>'+locations.length+' '+arr[a]+ '</li>');
                            plot_map(locations, arr[a]);
                        }
                        else {
                            jQuery("#final_loading_status_div").append('<li><i class="fa fa-check"></i>0 '+arr[a]+ '</li>');
                        }
                    });
                }
                else {
                    clearInterval(myInterval);
                    jQuery("#loading_div").css('display','none');
                }
            }

            function plot_map(locations,amenity) {
                for (i = 0; i < locations.length; i++) {
                    if (locations[i][1]) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            map: map,
                            icon: 'http://localhost:8887/ARP_B_research/images/' + amenity + '.png'
                        });

                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                            return function () {
                                infowindow.setContent(locations[i][0] + "<br/>" + locations[i][4]);
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    }
                }
            }








        });


        function add_remove_fav(userid,mlsnum,proptype) {
            //alert(userid+'--'+mlsnum+'--'+proptype);
            jQuery.ajax({
                type: 'POST',
                url: '{{ url('/') }}/ajax/add_remove_fav.php',
                data: {
                    userid: userid,
                    mlsnum: mlsnum,
                    proptype: proptype
                },
                success: function(data, textStatus, XMLHttpRequest){
                    if(data == 'added') {
                        jQuery('#add_remove_fav_'+mlsnum+' span').attr('id', 'sel');
                    }
                    else if(data == 'removed') {
                        jQuery('#add_remove_fav_'+mlsnum+' span#sel').removeAttr('id');
                    }
                }
            });
        }

        function add_remove_communities_fav(userid,community_id,proptype) {
            //alert(userid+'--'+mlsnum+'--'+proptype);
            jQuery.ajax({
                type: 'POST',
                url: '{{ url('/') }}/ajax/add_remove_communities_fav.php',
                data: {
                    userid: userid,
                    community_id: community_id,
                    proptype: 'communities'
                },
                success: function(data, textStatus, XMLHttpRequest){
                    if(data == 'added') {
                        jQuery('#add_remove_communities_fav_'+community_id+' span').attr('id', 'sel');
                    }
                    else if(data == 'removed') {
                        jQuery('#add_remove_communities_fav_'+community_id+' span#sel').removeAttr('id');
                    }
                }
            });
        }


    </script>






    <script type="text/javascript">

        var didsignedup = '';
        function checkUniqueEmail() {
            $.get( "{{ url('/') }}/ajax/checkUniqueEmail.php?email="+$("#semail").val(), function( data ) {

                if (data == 'user exists') {
                    $("#semail").css('background-color','#FFE0E0');
                    swal({
                        title: "User already exists.",
                        text: 'User with this email address is already exists. Please try with different email address',
                        html: true,
                        type: "error"
                    });
                    return false;
                }
                else {
                    $.post( "{{ url('/') }}/ajax/signup.php", $( "#signupform" ).serialize(),function(data, status){

                        if(data=='not a robot') {
                            swal({
                                title: "Are you a robot?",
                                text: 'Please confirm that you are not a robot',
                                html: true,
                                type: "error"
                            });
                            return false;
                        }
                        else if(data=='signup done') {
                            didsignedup = '1';
                            swal({
                                    title: "Successfull",
                                    text: 'Your are successfully signed up and you are logged in now.',
                                    html: true,
                                    type: "success"
                                },
                                function(){
                                    //location.reload();
                                    $("#sliding1").animate({
                                        marginLeft: '-55%'
                                    }, 500);
                                });
                            return false;
                        }
                    });

                    return false;
                }
            });
        }

        function loginToAccount(){
            $.get( "{{ url('/') }}/ajax/signin.php?login_email="+$("#login_email").val()+"&login_pass="+$("#login_pass").val(), function( data ) {
                //alert(data);
                if(data=='login sucessful') {
                    location.reload();
                }
                else {
                    $("#login_error").css('display','block');
                }
            });
        }

        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        function formvalidation() {
            var flag = 0;
            if(jQuery("#uname").val() =='') {
                jQuery("#uname").css('border','1px solid #ff0000');
                flag = 1;
            }
            else {
                jQuery("#uname").css('border','1px solid #e4e4e4');
            }

            if(jQuery("#uemail").val() =='') {
                jQuery("#uemail").css('border','1px solid #ff0000');
                flag = 1;
            }
            else if(!IsEmail(jQuery("#uemail").val())) {
                jQuery("#uemail").css('border','1px solid #ff0000');
                flag = 1;
            }
            else {
                jQuery("#uemail").css('border','1px solid #e4e4e4');
            }

            if(jQuery("#cell").val() =='') {
                jQuery("#cell").css('border','1px solid #ff0000');
                flag = 1;
            }
            else {
                jQuery("#cell").css('border','1px solid #e1e1e1');
            }

            if(jQuery("#showing_time").val() =='') {
                jQuery("#showing_time").css('border','1px solid #ff0000');
                flag = 1;
            }
            else {
                jQuery("#showing_time").css('border','1px solid #e1e1e1');
            }

            if(jQuery("#message").val() =='') {
                jQuery("#message").css('border','1px solid #ff0000');
                flag = 1;
            }
            else {
                jQuery("#message").css('border','1px solid #e1e1e1');
            }


            if(flag == 1) {
                return false;
            }
            else {
                return true;
            }
        }

        function rformvalidation() {
            var flag = 0;
            if(jQuery("#rname").val() =='') {
                jQuery("#rname").css('border','1px solid #ff0000');
                flag = 1;
            }
            else {
                jQuery("#rname").css('border','1px solid #e4e4e4');
            }

            if(jQuery("#remail").val() =='') {
                jQuery("#remail").css('border','1px solid #ff0000');
                flag = 1;
            }
            else if(!IsEmail(jQuery("#remail").val())) {
                jQuery("#remail").css('border','1px solid #ff0000');
                flag = 1;
            }
            else {
                jQuery("#remail").css('border','1px solid #e4e4e4');
            }

            if(jQuery("#rcell").val() =='') {
                jQuery("#rcell").css('border','1px solid #ff0000');
                flag = 1;
            }
            else {
                jQuery("#rcell").css('border','1px solid #e1e1e1');
            }



            if(jQuery("#rmessage").val() =='') {
                jQuery("#rmessage").css('border','1px solid #ff0000');
                flag = 1;
            }
            else {
                jQuery("#rmessage").css('border','1px solid #e1e1e1');
            }


            if(flag == 1) {
                return false;
            }
            else {
                return true;
            }
        }

        function formvalidation_reg() {
            var flag = 0;
            if($("#sfirst_name").val() =='') {
                //$("#sfirst_name").css('border','1px solid #ff0000');
                $("#sfirst_name").css('background-color','#FFE0E0');
                flag = 1;
            }
            else {
                //$("#sfirst_name").css('border','1px solid #cccccc');
                $("#sfirst_name").css('background-color','#fff');
            }

            if($("#slast_name").val() =='') {
                //$("#slast_name").css('border','1px solid #ff0000');
                $("#slast_name").css('background-color','#FFE0E0');
                flag = 1;
            }
            else {
                //$("#slast_name").css('border','1px solid #cccccc');
                $("#slast_name").css('background-color','#fff');
            }

            if($("#semail").val() =='') {
                //$("#semail").css('border','1px solid #ff0000');
                $("#semail").css('background-color','#FFE0E0');
                flag = 1;
            }
            else if(!IsEmail($("#semail").val())) {
                //$("#semail").css('border','1px solid #ff0000');
                $("#semail").css('background-color','#FFE0E0');
                flag = 1;
            }
            else {
                //$("#semail").css('border','1px solid #cccccc');
                $("#semail").css('background-color','#fff');
            }

            if($("#scell").val() =='') {
                //$("#scell").css('border','1px solid #ff0000');
                $("#scell").css('background-color','#FFE0E0');
                flag = 1;
            }
            else {
                //$("#scell").css('border','1px solid #cccccc');
                $("#scell").css('background-color','#fff');
            }

            if($("#spassword").val() =='') {
                //$("#spassword").css('border','1px solid #ff0000');
                $("#spassword").css('background-color','#FFE0E0');
                flag = 1;
            }
            else {
                //$("#spassword").css('border','1px solid #cccccc');
                $("#spassword").css('background-color','#fff');
            }


            if(flag == 1) {
                return false;
            }
            else {
                checkUniqueEmail();
                //return false;
            }
        }



        jQuery(function(){

            $('#nextid').bind('click',function(e){
                formvalidation_reg();
                e.preventDefault();
            });

            $('#pop-login').on('hidden.bs.modal', function () {
                // do something…
                //alert('dd');
                if(didsignedup == '1') {
                    location.reload();
                }
            })

            jQuery('#showing_time').datetimepicker({
                timeFormat: "hh:mm tt",
            });

            <?php
            if(!empty($_POST['uname'])) {
            if(empty($_POST['g-recaptcha-response'])) { ?>
            //jQuery(window).scrollTop($('#contact').offset().top);
            //jQuery("#captcha_text").css('border','1px solid #ff0000');
            jQuery("#messagesentfailed").css('display','block');
            <?php }
            else { ?>
            jQuery("#messagesent").css('display','block');
            jQuery("#uname").val('');
            jQuery("#uemail").val('');
            jQuery("#cell").val('');
            jQuery("#showing_time").val('');
            jQuery("#message").val('');
            <?php }
            }
            ?>
        });

        function showMoreCities() {
            jQuery(".show_later").css('display','block');
            jQuery("#display_more").css('display','none');
            jQuery("#display_less").css('display','block');
        }

        function showLessCities() {
            jQuery(".show_later").css('display','none');
            jQuery("#display_more").css('display','block');
            jQuery("#display_less").css('display','none');
        }

    </script>
@endsection
