@extends('adminlte::master')

@section('adminlte_css')
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
{{--        <div class="register-logo">--}}
{{--            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Te</b>MoP') !!}</a>--}}
{{--        </div>--}}

        <div class="register-box-body">
            <p class="login-box-msg">Register Your Company</p>
            <p class="error-content"><small>Make sure you do not register a company twice</small></p>
{{--            <p> {{session('errors')->first('message')}} </p>--}}
            <form action="#" method="post">
                @csrf
                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                           placeholder="Company Name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('date') ? 'has-error' : '' }}">
                    <input type="date" name="yearFounded" class="form-control" value="{{ old('date') }}"
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
                           placeholder="Type of Company">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('mobile') ? 'has-error' : '' }}">
                    <input type="number" name="mobile" class="form-control"
                           placeholder="Enter Phone Number">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('mobile'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control"
                           placeholder="Enter valid Email Address">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    Register Company
                </button>
            </form>
            <br>
            <p>
                If your company is already registered, click <a class="bg-red" href="#">here</a>  to delete your account and ask the administrator to create for you an account
            </p>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
