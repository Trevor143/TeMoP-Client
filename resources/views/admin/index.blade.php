@extends('adminlte::page')

@section('title', 'Dashboard')

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
                                                <a href="#"><button class="btn bg-olive">View Details</button></a>
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
{{--                                        <th>Actions</th>--}}
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
                                            <td>
{{--                                                <a href=" {{route('tender.show', $tender->id)}}"><button class="btn bg-maroon"> View Tender</button></a>--}}
{{--                                                <a href="#"><button class="btn bg-olive">View Details</button></a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Reference Number</th>
                                        <th>Tender Name</th>
                                        <th>Date of submission</th>
                                        <th>Deadline date</th>
{{--                                        <th>Actions</th>--}}
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#tenders').DataTable( {
                "scrollX": true,
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            } );
        } );
    </script>
@stop
