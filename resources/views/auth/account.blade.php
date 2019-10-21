@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Account</h1><small>Details of your account are found here</small>
@stop

@section('css')
    <style>
        .error{ color:red; }
    </style>
@stop

@section('content')
    <div class="row ">
        <div class="col-md-10 col-md-offset-1">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Your Details</a></li>
                    <li><a href="#passwords" data-toggle="tab">Change Password</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="details">
                        Something
                    </div>
                    <div class="tab-pane " id="passwords">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Change Your Password</h3>
                            </div>

                            <form role="form" id="change_password" method="post" action="javascript:void(0)">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="current">Current Password</label>
                                        <input type="password" name="current" class="form-control" id="current"
                                               placeholder="Please enter your current password">
                                        <span class="text-danger">{{ $errors->first('current') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                               placeholder="Enter a new password">
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm new password</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               id="password_confirmation" placeholder="Confirm new Password0">
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    </div>
                                    <div class="alert alert-success d-none" id="msg_div" style="display: none;" >
                                        <span id="res_message"></span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id="send_form" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
        $("#change_password").validate({

            rules: {
                current: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: '#password'

                },
            },
            messages: {

                current: {
                    required: "Your old password is required",
                },
                password: {
                    required: "You need to enter a new password",
                    minlength: "Password should be at least 6 characters",
                },
                password_confirmation: {
                    required: "Confirm your password",
                    minlength: "Ensure the password is 6 characters or more",
                    equalTo: "Passwords do not match"
                },

            },

            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#send_form').html('Changing');
                $.ajax({
                    url: '<?php echo url()->current() ?>'+'/password',
                    type: "POST",
                    data: $('#change_password').serialize(),
                    success: function( response ) {
                        $('#send_form').html('Submit');
                        $('#msg_div').show();
                        // $('#res_message').show();
                        $('#res_message').html(response.msg);
                        $('#msg_div').removeClass('d-none');

                        // document.getElementById("change_password").reset();
                        $('#change_password').reset();
                        setTimeout(function(){
                            $('#res_message').hide();
                            $('#msg_div').hide();
                        },10000);
                    }
                });
            }
        })
</script>
@stop
