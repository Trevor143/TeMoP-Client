@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tenders </h1><small>All Published Tenders</small>
@stop

@section('content')
    <div class="row ">
        <div class="col-md-10 col-md-offset-1">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#placeBid" data-toggle="tab">Place Your Bid Here</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="placeBid">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Place your bid <small>Ensure all details required are filled</small></h3>
                            </div>
                            <form role="form" action="{{route('bid.update', $bidd->id)}}" method="post" id="placeBidForm" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden" name="tender_id" value="{{$tender->id}} ">
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                        <table class="table-responsive " style="width:80%">
                                            <thead>
                                            <tr>
                                                <th>File required</th>
                                                <th>File Uploaded</th>
                                                <th>File <strong>(pdf)</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bidd->files as $key=>$file)
                                                <tr>
                                                @if($tender['requiredDocs'])
                                                    <td><input type="text" value="{{$file->filename}}" class="form-control" disabled></td>
                                                    <input type="hidden" name="filename[]" value="{{$file->filename}}">
                                                    <td>
                                                        <input type="text" value="{{ preg_replace('/^bids/','',$file->fileurl)}}" class="form-control" disabled>
                                                        <input type="hidden" name="oldfile{{$key}}" value="{{$file->fileurl}}">
                                                    </td>
                                                    <td>
                                                        <input multiple type="file" id="req_file" name="file{{$key}}" class="form-control">                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                @foreach ($errors->all() as $error)
                                                                    {{ $error }}
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </td>
                                                @else
                                                    <td>No documents required. Just place bid</td>
                                                    <td>-</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
        $("#placeBidForm").validate({

            rules: {
                req_file: {
                    required: true,

                },
            },
            messages: {

                req_file: {
                    required: "This cannot be blank",

                },

            },

            {{--submitHandler: function(form) {--}}
            {{--    $.ajaxSetup({--}}
            {{--        headers: {--}}
            {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--        }--}}
            {{--    });--}}
            {{--    $('#send_form').html('Changing');--}}
            {{--    $.ajax({--}}
            {{--        url: '<?php echo url()->current() ?>'+'/password',--}}
            {{--        type: "POST",--}}
            {{--        data: $('#change_password').serialize(),--}}
            {{--        success: function( response ) {--}}
            {{--            $('#send_form').html('Submit');--}}
            {{--            $('#msg_div').show();--}}
            {{--            // $('#res_message').show();--}}
            {{--            $('#res_message').html(response.msg);--}}
            {{--            $('#msg_div').removeClass('d-none');--}}

            {{--            // document.getElementById("change_password").reset();--}}
            {{--            $('#change_password').reset();--}}
            {{--            setTimeout(function(){--}}
            {{--                $('#res_message').hide();--}}
            {{--                $('#msg_div').hide();--}}
            {{--            },10000);--}}
            {{--        }--}}
            {{--    });--}}
            {{--}--}}
        })

    </script>
@stop
