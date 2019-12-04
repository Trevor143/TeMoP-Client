@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tenders </h1><small>All Published Tenders</small>
@stop

@section('content')

    <div class="col-md-5">
        @foreach($tenders as $tender)
        <div class="box box-widget">
            <div class="box-header">
                {{$tender->name}}
            </div>
            <div class="box-body">
                <a href="{{route('timeline', $tender->id)}}"><button class="btn btn-success">Show Timelines</button></a>
            </div>
        </div>
            @endforeach
    </div>

@stop
