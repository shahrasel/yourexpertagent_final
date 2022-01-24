@extends('layouts.app')

@section('content')
<section id="section-body">

    <section id="section-body">
        <div class="container">
            <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-left">
                            <h2>Compare Properties</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div id="content-area">
                        <div class="compare-table-wrap">
                            <form action="" method="post">
                                @csrf
                                <div style="padding-bottom: 30px; text-align: center">
                                    <input type="submit" value="COMPARE" class="btn btn-primary">
                                </div>
                                <table class="compare-table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="table-title"></th>
                                        <th>
                                            <div class="compare-media">
                                                <div class="compare-thumb">
                                                    <input type="text" class="form-control" name="property1" placeholder="MLS #" style="max-width: 224px" value="{{ request()->property1 }}">
                                                </div>
                                                <div class="compare-thumb">
                                                    @if(!empty($property1['photo1_url']))
                                                        <img src="<?php echo str_replace('http://matrixrets.ntreis.net/Rets/GetRetsMedia.ashx','http://matrixmedia.ntreis.net/mediaserver/GetMedia.ashx',$property1['photo1_url']) ?>" width="224" style="min-width: 224px" height="148" >
                                                    @endif
                                                </div>
                                                <div class="compare-caption">
                                                    <p class="compare-price">
                                                        <?php if(!empty($property1)) { echo '$'.number_format($property1['LISTPRICE']); } ?>
                                                    </p>
                                                    <p class="compare-type"><strong>Type:</strong> <?php if(!empty($property1)) { echo $property1['PROPSUBTYPE']; } ?></p>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="compare-media">
                                                <div class="compare-thumb">
                                                    <input type="text" class="form-control" name="property2" placeholder="MLS #" style="max-width: 224px" value="{{ request()->property2 }}">
                                                </div>
                                                <div class="compare-thumb">
                                                    @if(!empty($property2['photo1_url']))
                                                        <img src="<?php echo str_replace('http://matrixrets.ntreis.net/Rets/GetRetsMedia.ashx','http://matrixmedia.ntreis.net/mediaserver/GetMedia.ashx',$property2['photo1_url']) ?>" width="224" style="min-width: 224px" height="148" >
                                                    @endif
                                                </div>
                                                <div class="compare-caption">
                                                    <p class="compare-price">
                                                        <?php if(!empty($property2)) { echo '$'.number_format($property2['LISTPRICE']); } ?>
                                                    </p>
                                                    <p class="compare-type"><strong>Type:</strong> <?php if(!empty($property2)) { echo $property2['PROPSUBTYPE']; } ?></p>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="compare-media">
                                                <div class="compare-thumb">
                                                    <input type="text" class="form-control" name="property3" placeholder="MLS #" style="max-width: 224px" value="{{ request()->property3 }}">
                                                </div>
                                                <div class="compare-thumb">
                                                    @if(!empty($property3['photo1_url']))
                                                        <img src="<?php echo str_replace('http://matrixrets.ntreis.net/Rets/GetRetsMedia.ashx','http://matrixmedia.ntreis.net/mediaserver/GetMedia.ashx',$property3['photo1_url']) ?>" width="224" style="min-width: 224px" height="148" >
                                                    @endif
                                                </div>
                                                <div class="compare-caption">
                                                    <p class="compare-price">
                                                        <?php if(!empty($property3)) { echo '$'.number_format($property3['LISTPRICE']); } ?>
                                                    </p>
                                                    <p class="compare-type"><strong>Type:</strong> <?php if(!empty($property3)) { echo $property3['PROPSUBTYPE']; } ?></p>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="table-title">Address</td>
                                        <td>
                                            <?php
                                            if(!empty($property1)) {
                                                echo $property1['STREETNUM'].' '.$property1['STREETDIR'].' '.$property1['STREETNAME'].' '.$property1['STREETTYPE'];
                                            } ?>
                                        </td>
                                        <td>
                                            <?php
                                            if(!empty($property2)) {
                                                echo $property2['STREETNUM'].' '.$property2['STREETDIR'].' '.$property2['STREETNAME'].' '.$property2['STREETTYPE'];
                                            } ?>
                                        </td>
                                        <td>
                                            <?php
                                            if(!empty($property3)) {
                                                echo $property3['STREETNUM'].' '.$property3['STREETDIR'].' '.$property3['STREETNAME'].' '.$property3['STREETTYPE'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-title">City</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo $property1['CITY'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo $property2['CITY'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo $property3['CITY'];
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="table-title">State/Country</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo $property1['STATE'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo $property2['STATE'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo $property3['STATE'];
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="table-title">Zip</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo $property1['ZIPCODE'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo $property2['ZIPCODE'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo $property3['ZIPCODE'];
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="table-title">Bed</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo $property1['BEDS'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo $property2['BEDS'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo $property3['BEDS'];
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="table-title">Bath</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo $property1['BATHSFULL'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo $property2['BATHSFULL'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo $property3['BATHSFULL'];
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="table-title">Garage</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo $property1['GARAGECAP'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo $property2['GARAGECAP'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo $property3['GARAGECAP'];
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="table-title">Size</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo number_format($property1['SQFTTOTAL']).' Sqft';
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo number_format($property2['SQFTTOTAL']).' Sqft';
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo number_format($property3['SQFTTOTAL']).' Sqft';
                                            } ?></td>
                                    </tr>
                                    <tr class="tr-head">
                                        <td class="table-title">Additional details</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="table-title">Area</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo $property1['AREATITLE'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo $property2['AREATITLE'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo $property3['AREATITLE'];
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <td class="table-title">Style</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo $property1['STYLE'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo $property2['STYLE'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo $property3['STYLE'];
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <td class="table-title">Stories</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo $property1['STORIES'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo $property2['STORIES'];
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo $property3['STORIES'];
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <td class="table-title">Exterior</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo str_replace(',',', ',$property1['EXTERIOR']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo str_replace(',',', ',$property2['EXTERIOR']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo str_replace(',',', ',$property3['EXTERIOR']);
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <td class="table-title">Interior</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo str_replace(',',', ',$property1['INTERIOR']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo str_replace(',',', ',$property2['INTERIOR']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo str_replace(',',', ',$property3['INTERIOR']);
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <td class="table-title">Heating</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo str_replace(',',', ',$property1['Heating']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo str_replace(',',', ',$property2['Heating']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo str_replace(',',', ',$property3['Heating']);
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <td class="table-title">Construction Material</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo str_replace(',',', ',$property1['ConstructionMaterials']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo str_replace(',',', ',$property2['ConstructionMaterials']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo str_replace(',',', ',$property3['ConstructionMaterials']);
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <td class="table-title">Flooring</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo str_replace(',',', ',$property1['Flooring']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo str_replace(',',', ',$property2['Flooring']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo str_replace(',',', ',$property3['Flooring']);
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <td class="table-title">Kitchen Equipment</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo str_replace(',',', ',$property1['ROOMKITCHENDESC']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo str_replace(',',', ',$property2['ROOMKITCHENDESC']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo str_replace(',',', ',$property3['ROOMKITCHENDESC']);
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <td class="table-title">Parking/Garage Description</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo str_replace(',',', ',$property1['GARAGEDESC']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo str_replace(',',', ',$property2['GARAGEDESC']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo str_replace(',',', ',$property3['GARAGEDESC']);
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <td class="table-title">Utility</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo str_replace(',',', ',$property1['ROOMUTILDESC']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo str_replace(',',', ',$property2['ROOMUTILDESC']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo str_replace(',',', ',$property3['ROOMUTILDESC']);
                                            } ?></td>
                                    </tr>

                                    <tr>
                                        <td class="table-title">Common Features</td>
                                        <td><?php
                                            if(!empty($property1)) {
                                                echo str_replace(',',', ',$property1['COMMONFEATURES']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property2)) {
                                                echo str_replace(',',', ',$property2['COMMONFEATURES']);
                                            } ?></td>
                                        <td><?php
                                            if(!empty($property3)) {
                                                echo str_replace(',',', ',$property3['COMMONFEATURES']);
                                            } ?></td>
                                    </tr>


                                    </tbody>

                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>
@endsection
