@extends('adminlte::page')

@section('content-header')
    <section class="content-header">
        <h1>
            Task Details  <small> Any comments on any specific task should be make here</small>
        </h1>

        <ol class="breadcrumb">
{{--            <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>--}}
            <li class="active">Task Details</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h1 class="box-title">{{$task->text}}</h1>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <h3>Project Task : <small class="btn btn-success">{{$task->type}}</small></h3>
                <h3>Person in charge:
                    @isset($task->user->name)
                        <strong>{{$task->user->name }} </strong>
                    @else
                        <strong>Unassigned</strong>
                    @endisset</h3>
                <h3>Start Date: <strong>{{$task->start_date->isoFormat('dddd D, MMMM Y')}}</strong></h3>
                <h3>End Date: <strong>{{$task->start_date->addDays($task->duration  )->isoFormat('dddd D, MMMM Y')}}</strong></h3>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <div class="col-md-8">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h1 class="box-title">Comments and Inquiries</h1>
            </div>
            <div class="box-body">
                @comments(['model' => $task])
                </div>
        </div>
    </div>
@stop
