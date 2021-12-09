<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Expert Agent - Search Your Dream Homes</title>
    <!--Meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="New homes, new homes for sale, home builders">
    <meta name="description" content="Search New Communities, New Homes for Sale and Home Builders.">
    <meta name="author" content="Your Expert Agent">
    <meta name="wot-verification" content="cf4c806d398973ab7f17"/>
    <meta property="fb:app_id" content="213626955782780"/>
    <meta property="og:description" content="Search New Communities, New Homes for Sale and Home Builders."/>
    <meta property="og:title" content="Search New Communities, Homes for Sale and Home Builders"/>


    <meta name="apple-itunes-app" content="app-id=1281722341, affiliate-data=myAffiliateData, app-argument=myURL">

    <link rel="apple-touch-icon" sizes="144x144" href="images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="images/favicons/manifest.json">
    <link rel="mask-icon" href="images/favicons/safari-pinned-tab.svg" >
    <meta name="theme-color" content="#ffffff">



    <link href="{{ asset('css/bootstrap.css?v='.time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap-select.css?v='.time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/font-awesome.css?v='.time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/owl.carousel.css?v='.time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css?v='.time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery-ui.css?v='.time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/styles.css?v='.time()) }}" rel="stylesheet" type="text/css" />

    @yield('style_sheets')

</head>
<body>

<button class="btn scrolltop-btn back-top"><i class="fa fa-angle-up"></i></button>
<div class="modal fade" id="pop-login" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="login-tabs">
                    <li class="active">Login</li>
                    <li>Sign Up</li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>

            </div>
            <div class="modal-body login-block" style="overflow:hidden">
                <div class="tab-content">
                    <div class="tab-pane fade in active">
                        <div class="message">
                            <p>Please sign in to access your account<br/></p>
                            <p class="error text-danger" id="login_error" style="display:none"><i class="fa fa-close"></i> Incorrect email or password given.</p>
                        </div>
                        <form>
                            <div class="form-group field-group">
                                <div class="input-user input-icon">
                                    <input type="text" placeholder="Email" name="login_email" id="login_email">
                                </div>
                                <div class="input-pass input-icon">
                                    <input type="password" placeholder="Password" name="login_pass" id="login_pass">
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary btn-block" onclick="loginToAccount()">Login</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" style="text-align:center;width:220%;">
                        <form id="signupform">
                            <div id="sliding1" style="float:left;width:50%;">
                                <div style="margin-right:10%;">
                                    <h2>Welcome!</h2>
                                    <p>Sign Up and start saving properties and communities in your My Saved. Please fill out the following:<br/></p>
                                    <div class="form-group field-group">
                                        <div class="input-user input-icon">
                                            <input type="text" placeholder="First Name" name="first_name" id="sfirst_name">
                                        </div>
                                        <div class="input-user input-icon">
                                            <input type="text" placeholder="Last Name" name="last_name" id="slast_name">
                                        </div>
                                        <div class="fa-phone input-icon">
                                            <input type="text" placeholder="Cell" name="cell" id="scell">
                                        </div>
                                        <div class="input-email input-icon">
                                            <input type="email" placeholder="Email"  name="email" id="semail">
                                        </div>
                                        <div class="input-pass input-icon">
                                            <input type="password" placeholder="Password"  name="password" id="spassword">
                                        </div>

                                    </div>
                                    <div class="g-recaptcha" data-sitekey="6LduCUAUAAAAAEJrkvGVCtbiqhZIp0CENvpj_OR1"></div>
                                    <button type="submit" class="btn btn-primary btn-block" id="nextid" style="margin-top:15px;">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <div  id="sliding2" style="float:left;width:50%;">
                            <div style="margin-right:10%;">
                                <h2>Almost Done!</h2>
                                <p>To help us better understand your current moving status, please answer the following 3 simple questions:<br/></p>

                                <div>
                                    <p>Do you have a Realtor?<br/>
                                        <input type="radio" name="have_realtor" id="have_realtor_yes" checked="checked" value="yes"><label for="have_realtor_yes">&nbsp;&nbsp;Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="have_realtor" id="have_realtor_no" value="no"><label for="have_realtor_no">&nbsp;&nbsp;No</label>
                                    </p>
                                </div>

                                <div>
                                    <p> Do you need a home loan?<br/>
                                        <input type="radio" name="need_home_loan" id="need_home_loan_yes" checked="checked" value="yes"><label for="need_home_loan_yes">&nbsp;&nbsp;Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="need_home_loan" id="need_home_loan_no" value="no"><label for="need_home_loan_no">&nbsp;&nbsp;No</label>
                                    </p>
                                </div>

                                <div class="btn-group bootstrap-select">
                                    <p>How soon do you like to move?<br/>
                                        <select class="selectpicker" id="how_soon_move" data-live-search="false" data-live-search-style="begins" title="How soon do you want to move" name="how_soon_move">
                                            <option value="0-3 months">0-3 months</option>
                                            <option value="4-6 months">4-6 months</option>
                                            <option value="6-12 months">6-12 months</option>
                                            <option value="12+ months">12+ months</option>
                                            <option value="I'm not sure">I'm not sure</option>
                                        </select>
                                    </p>
                                </div>
                                <button type="button" class="btn btn-success btn-block" onclick="saveAdditionalInfo()">Done</button>

                                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" aria-label="Close">Skip</button>
                            </div>
                        </div>
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
<header id="header-section" class="header-section-4 header-main  nav-left hidden-sm hidden-xs" data-sticky="1">
    <div class="container">
        <div class="header-left">
            <div class="logo" style="max-width: 190px">
                <a href="{{ url('/') }}">
                    {{--<img src="{{ url('/') }}images/houzez-logo-color.png" alt="Your Expert Agent">--}}
                    Your Expert Agent
                </a>
            </div>
            <nav class="navi main-nav">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/') }}search?property_type=Residential&city_zip=<?php echo 'Dallas, TX' ?>">Search New Homes</a></li>
                    <li><a href="{{ url('/') }}contact">Support Contact</a></li>

                </ul>
                </li>
                </ul>
            </nav>
        </div>
        <div class="header-right">
            {{--<div class="user">
                <?php if(!empty($_SESSION['front_user'])): ?>
                <nav class="navi main-nav">
                    <ul class="sub-menu">
                        <li>
                            <a href="#">User Settings</a>
                            <ul class="sub-menu" style="width:auto">
                                <li><a href="{{ url('/') }}my-profile/">My Profile</a></li>
                                <li><a href="{{ url('/') }}my-saved/">My Saved</a></li>
                                <li><a href="{{ url('/') }}logout/">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <?php else: ?>
                <a href="#" data-toggle="modal" data-target="#pop-login">Sign In / Sign Up</a>
            <?php endif; ?>
            </div>--}}
        </div>
    </div>
</header>
<div class="header-mobile visible-sm visible-xs">
    <div class="container">
        <!--start mobile nav-->
        <div class="mobile-nav">
            <span class="nav-trigger"><i class="fa fa-navicon"></i></span>
            <div class="nav-dropdown main-nav-dropdown"></div>
        </div>
        <!--end mobile nav-->
        <div class="header-logo">
            <a href="index.html">Your Expert Agent</a>
        </div>
        <div class="header-user">
            <ul class="account-action">
                <li>
                    <span class="user-icon"><i class="fa fa-user"></i></span>
                    <div class="account-dropdown">
                        <ul>
                            <li><a href="{{ url('/') }}my-profile/"><i class="fa fa-plus-circle"></i>My Profile</a></li>
                            <li><a href="{{ url('/') }}my-saved/"><i class="fa fa-save"></i>My Saved</a></li>
                            <li><a href="{{ url('/') }}logout/"><i class="fa fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

@yield('content')

<!--start footer section-->
<footer class="footer-v2">
    <div class="footer">
        <div class="container">
            <h2 style="color: #fff">Search new homes in different cities</h2>
            <div class="row">

                <ul class="list-four-col">
                    @php $i=1 @endphp
                    @foreach($cityLists as $cityList)
                        <li @if($i<=64) class="show_init" @else class="show_later" @endif  style="list-style:none"><a href="{{ url('/') }}/search.php?property_type=Residential&city_zip={{ $cityList->CITY }}, TX">{{ $cityList->CITY }} new homes for sale</a></li>
                        @php $i++ @endphp
                     @endforeach
                </ul>
                <div style="text-align: center;">
                    <a id="display_more" style="color: #fff;cursor:pointer;font-weight: bold;font-size: 14px" onclick="showMoreCities()">Show More Cities</a>
                    <a id="display_less" style="color: #fff;cursor:pointer;font-weight: bold;font-size: 14px;display: none" onclick="showLessCities()">Show Less Cities</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="footer-col">
                        <p>© <?php echo date('Y') ?> Your Expert Agent - All rights reserved</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="footer-col">
                        <div class="navi">
                            <ul id="footer-menu" class="">
                                <li><a href="{{ url('/') }}privacy-policy">Privacy Policy</a></li>
                                <li><a href="{{ url('/') }}terms-of-use">Terms Of Use</a></li>
                                <li><a href="{{ url('/') }}contact">Support Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="footer-col foot-social">
                        <p>
                            Follow us
                            <a target="_blank" class="btn-facebook" href="https://facebook.com/"><i class="fa fa-facebook-square"></i></a>

                            <a target="_blank" class="btn-twitter" href="https://twitter.com/"><i class="fa fa-twitter-square"></i></a>

                            <a target="_blank" class="btn-linkedin" href="http://linkedin.com"><i class="fa fa-linkedin-square"></i></a>

                            <a target="_blank" class="btn-google-plus" href="http://google.com"><i class="fa fa-google-plus-square"></i></a>

                            <a target="_blank" class="btn-instagram" href="http://instagram.com"><i class="fa fa-instagram"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--end footer section-->
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/modernizr.custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.matchHeight-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.nicescroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
<script>
    var didsignedup = '';
    function checkUniqueEmail() {
        $.get( "{{ url('/') }}ajax/checkUniqueEmail.php?email="+$("#semail").val(), function( data ) {

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
                $.post( "{{ url('/') }}ajax/signup.php", $( "#signupform" ).serialize(),function(data, status){

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
        $.get( "{{ url('/') }}ajax/signin.php?login_email="+$("#login_email").val()+"&login_pass="+$("#login_pass").val(), function( data ) {
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
            formvalidation();
            e.preventDefault();
        });

        $('#pop-login').on('hidden.bs.modal', function () {
            // do something…
            //alert('dd');
            if(didsignedup == '1') {
                location.reload();
            }
        })
    });

    function add_remove_fav(userid,mlsnum,proptype) {
        //alert(userid+'--'+mlsnum+'--'+proptype);
        jQuery.ajax({
            type: 'POST',
            url: '{{ url('/') }}ajax/add_remove_fav.php',
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
            url: '{{ url('/') }}ajax/add_remove_communities_fav.php',
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

<script>
    jQuery(function(){
        var citystr = '';
        var availableTags = [];
        @foreach($cityLists as $cityList)
            availableTags.push("{{ $cityList->CITY }}, TX");
        @endforeach
        $( "#autocomplete" ).autocomplete({
            source: availableTags
        });
    });
</script>

</body>
</html>
