@extends('layouts.app')

@section('content')
    <section id="section-body">

        <div class="container">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-left">
                            <h1 class="title-head">Welcome back, {{ $user_info->first_name }}</h1>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb"><li><a href="/"><i class="fa fa-home"></i></a></li><li class="active">My Profile</li></ol>
                        </div>
                    </div>
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="user-dashboard-full">
                    <div class="profile-area-content">
                        <div class="profile-area account-block white-block">


                            <div class="row">
                                <div class="col-md-4 col-sm-5">
                                    <div class="my-avatar">
                                        <?php if(!empty($user_info->image)): ?>
                                        <img src="<?php echo $user_info->image ?>>" alt="Avatar" style="max-width: 100px">
                                        <?php else: ?>
                                        <img src="{{ url('/') }}/images/user_avatar.png" alt="Avatar" style="max-width: 100px">
                                        <?php endif; ?>
                                        <input type="file" name="image">
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7">
                                    <?php if(!empty($err_str)): ?>
                                    <div style="color: #ff0000;text-align: center"><?php echo "User with this email already exists! Please change the email address." ?></div>
                                    <?php endif; ?>
                                    <h4>My Info</h4>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="firstname">First Name</label>
                                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter your first name" value="{{ $user_info->first_name  }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="lastname">Last Name</label>
                                                <input type="text" id="lastname" name="lastname" class="form-control" value="{{ $user_info->last_name  }}" placeholder="Enter your first name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" class="form-control" placeholder="Your email" value="{{ $user_info->email  }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="title">Cell</label>
                                                <input type="text" id="cell" name="cell" class="form-control" placeholder="Your cell number" value="{{ $user_info->primary_phone  }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div style="margin-top: 20px">&nbsp;</div>

                                    <h4>My Address</h4>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="address1">Age</label>
                                                <input type="text" id="age" name="age" class="form-control" value="{{ $user_info->age  }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="address2">Marital Status</label>
                                                <select name="marital_status" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <option @if($user_info->marital_status=='Unmarried') selected @endif value="Unmarried">Unmarried</option>
                                                    <option @if($user_info->marital_status=='Married') selected @endif value="Married">Married</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="address2">Have children?</label>
                                                <select name="have_children" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <option @if($user_info->have_children=='No') selected @endif value="No">No</option>
                                                    <option @if($user_info->have_children=='Yes') selected @endif value="Yes">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="address2">Profession</label>

                                                <select name="profession" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <option value="Teacher" @if($user_info->profession=='Teacher') selected @endif>Teacher</option>
                                                    <option value="Student" @if($user_info->profession=='Student') selected @endif>Student</option>
                                                    <option value="Doctor" @if($user_info->profession=='Doctor') selected @endif>Doctor</option>
                                                    <option value="Engineer" @if($user_info->profession=='Engineer') selected @endif>Engineer</option>
                                                    <option value="Banker" @if($user_info->profession=='Banker') selected @endif>Banker</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="{{ $user_info->id  }}">

                                    </div>
                                </div>
                            </div>
                            <div class="row" style="text-align: center">
                                <button type="submit" class="btn btn-primary">Update Info</button>
                            </div>
                        </div>
                        <div class="profile-area account-block white-block">
                            <h4>Change password</h4>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="newpass">New password</label>
                                        <input type="text" id="newpass" name="newpass" class="form-control" placeholder="Enter your new password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="confirmpass">Confirm password</label>
                                        <input type="text" id="confirmpass" name="confirmpass" class="form-control" placeholder="Confirm new password">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="text-align: center">
                                <button type="submit" class="btn btn-primary">Update password</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>

    </section>
@endsection
