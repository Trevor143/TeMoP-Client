@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Account</h1><small>Details of your account are found here</small>
@stop

@section('css')
    @toastr_css

<style>
        .error{ color:red; }
    </style>
@stop

@section('content')
    <div class="row ">
        <div class="col-md-10 col-md-offset-1">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#passwords" data-toggle="tab">Change Password</a></li>

                @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
                    <li ><a href="#details" data-toggle="tab">Company</a></li>
{{--                    <li><a href="#users" data-toggle="tab">Users</a></li>--}}
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active " id="passwords">
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

                @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
                    <div class="tab-pane" id="details">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <p class="login-box-msg">Update Company Details</p>
                            </div>
                            <form action="{{route('company.update', $company->id)}}" method="post">
                                @method('patch')
                                @csrf
                                <div class="box-body">
                                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <input type="text" name="name" class="form-control" value="{{$company->name}}"
                                               placeholder="Company Name">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group has-feedback {{ $errors->has('date') ? 'has-error' : '' }}">
                                        <input type="date" name="yearFounded" class="form-control" value="{{$company->yearFounded}}"
                                               placeholder="Company Start Date (Optional)">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group has-feedback {{ $errors->has('type') ? 'has-error' : '' }}">
                                        <input type="text" name="type" class="form-control"
                                               placeholder="Type of Company" value="{{$company->type}}">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        @if ($errors->has('type'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group has-feedback {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                        <input type="number" name="mobile" class="form-control"
                                               placeholder="Enter Phone Number" value="{{$company->mobile}}">
                                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                        @if ($errors->has('mobile'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <input type="email" name="email" class="form-control"
                                               placeholder="Enter valid Email Address" value="{{$company->email}}">
                                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                                        Update Company Details
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>

                    <div class="tab-pane" id="users">
                        <div class="box-primary">
                            <div class="box-header with-border">
                            </div>
                            <div class="box-body">
                                <table id="tenders" class="table table-bordered table-striped display nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date Added</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->created_at->isoFormat('dddd, D MMMM, Y')}}</td>
                                        </tr>
                                        @empty
                                        No data avaliable
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                </div>
            </div>

        </div>
    </div>
@stop

@section('js')

    @toastr_js
    @toastr_render

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
