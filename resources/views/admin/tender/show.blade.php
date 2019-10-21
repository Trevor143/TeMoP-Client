@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tenders </h1><small>All Published Tenders</small>
@stop

@section('content')
    {{--    @foreach($tenders as $tender)--}}
    <div class="row">
        <div class="col-lg-8">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="h5 mb-4 text-black box-title">Description</h4>
                </div>
                <div class="box-body">
                    <p class="lead">{{$tender->brief}}</p>
                    <br>
                    <div class="mb-5">
                        <h3 class="h5 mb-3 lead text-bold box-title">Tender Documents</h3>
                    </div>
                    <ul>
                        @foreach($tender['filename'] as $file)
                            <li><a href="{{Storage::url($file)}}">{{$file}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3 ml-auto">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="h5 text-black mb-3 box-title">Details</h3>
                </div>
                <div class="box-body">
                    <div class="mb-5">
                        <h3 class="h6 mb-4 lead text-black">Deadline</h3>
                    </div>
                    <p class="lead @if(Carbon\Carbon::parse($tender->deadline)->diffInDays($now) > 30)
                        bg-green @elseif(Carbon\Carbon::parse($tender->deadline)->diffInDays($now) > 14)
                        bg-yellow @elseif(Carbon\Carbon::parse($tender->deadline)->diffInDays($now) <= 14)
                        bg-red @endif ">
                        {{ Carbon\Carbon::parse($tender->deadline)->isoFormat('dddd, D MMMM, Y')}}
                    </p>
                    @if($bid)
                        <p>You have already placed your bid</p>
                    @else
                        <p>You have <strong>{{$tender->deadline->diffInDays($now)}} days</strong> left to apply</p>
                    @endif
                    <div class="mb-5">
                        <h3 class="h6 mb-4 lead text-black">Required Document</h3>
                        @foreach($tender['requiredDocs'] as $doc)
                            @if($tender['requiredDocs'])
                                <p class="">{{$doc['docName']}}</p>
                            @else
                                <p class="">No Documents required</p>
                            @endif
                        @endforeach
                    </div>
                    <hr>
                    @if(!$bid)
                        <div class="mb-5">
                            <a href="{{route('bid', $tender->id)}}"><button class="btn btn-success">Bid Now</button></a>
                        </div>
                    @else
                        <div class="mb-5">
                            You already placed your bid <br>
                            @if($tender->deadline->greaterThan(now()))
                                <a href="{{route('bid.edit', $bid->id)}}"><button class="btn btn-success">Edit Bid</button></a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
    {{--    @endforeach--}}
@stop
