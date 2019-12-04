@extends('adminlte::page')

@section('title', 'Tenders')

@section('content_header')
    <h1>Tenders </h1><small>All Published Tenders</small>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tenders" data-toggle="tab">Recent Tenders</a></li>
                    <li><a href="#bids" data-toggle="tab">Your Bids</a></li>
                    <li><a href="#awards" data-toggle="tab">Awarded</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tenders">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Tenders</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="tenders" class="table table-bordered table-striped display nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Reference Number</th>
                                        <th>Tender Name</th>
                                        <th>Department</th>
                                        <th>Deadline</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tenders as $tender)
                                        <tr>
                                            <td>{{$tender->id}}</td>
                                            <td>{{$tender->name}}</td>
                                            <td>{{$tender->organization->name}}</td>
                                            <td class="text-justify @if(Carbon\Carbon::parse($tender->deadline)->diffInDays($now) > 30)
                                                bg-green @elseif(Carbon\Carbon::parse($tender->deadline)->diffInDays($now) > 14)
                                                bg-yellow @elseif(Carbon\Carbon::parse($tender->deadline)->diffInDays($now) <= 14)
                                                bg-red @endif ">
                                                {{ Carbon\Carbon::parse($tender->deadline)->isoFormat('dddd, D MMMM, Y')}}</td>
                                            <td>
                                                <a href=" {{route('tender.show', $tender->id)}}"><button class="btn bg-maroon"> View Tender</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Reference Number</th>
                                        <th>Tender Name</th>
                                        <th>Department</th>
                                        <th>Deadline</th>
                                        <th>Actions</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="tab-pane" id="bids">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Your bids</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="tenders" class="table table-bordered table-striped display nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Reference Number</th>
                                        <th>Tender Name</th>
                                        <th>Date of Submission</th>
                                        <th>Deadline date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bids as $bid)
                                        <tr>
                                            <td>{{$bid->tender->id}}</td>
                                            <td>{{$bid->tender->name}}</td>
                                            <td>{{$bid->created_at->isoFormat('dddd, D MMMM, Y')}}</td>
                                            <td class="text-justify @if(Carbon\Carbon::parse($bid->tender->deadline)->diffInDays($now) > 30)
                                                bg-green @elseif(Carbon\Carbon::parse($bid->tender->deadline)->diffInDays($now) > 14)
                                                bg-yellow @elseif(Carbon\Carbon::parse($bid->tender->deadline)->diffInDays($now) <= 14)
                                                bg-red @endif ">
                                                {{ Carbon\Carbon::parse($bid->tender->deadline)->isoFormat('dddd, D MMMM, Y')}}</td>
                                            <td>{{$bid->tender->status}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Reference Number</th>
                                        <th>Tender Name</th>
                                        <th>Date of submission</th>
                                        <th>Deadline date</th>
                                        <th>Status</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="tab-pane" id="awards">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">

                                </h3>
                            </div>
                            <div class="box-body">
                                <table id="tenders" class="table table-bordered table-striped display nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Reference Number</th>
                                        <th>Tender Name</th>
                                        <th>Timelines</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($awards as $award)
                                    <tr>
                                        <td>{{$award->id}}</td>
                                        <td>{{$award->name}}</td>
                                        <td><a href="{{route('timeline', $award->id)}}"><button class="btn btn-success">Show Timelines</button></a></td>
                                        <td></td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    @toastr_css
@stop

@section('js')
    @toastr_js
    @toastr_render
@stop
