@extends('adminlte::page')

@section('title', 'Timeline')

@section('css')
    <link rel="stylesheet" href="{{asset('gantt_files/codebase/dhtmlxgantt.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
    <link rel="stylesheet" href="{{asset('gantt_files/samples/11_resources/common/jquery_multiselect.css')}}">
    <link rel="stylesheet" href="{{asset('gantt_files/samples/common/controls_styles.css')}}">
    <style>
        #title1 {
            padding-left: 35px;
            color: black;
            font-weight: bold;
        }

        #title2 {
            padding-left: 15px;
            color: black;
            font-weight: bold;
        }

        html, body {
            padding: 0px;
            margin: 0px;
            height: 100%;
        }

        #gantt_here {
            width:100%;
            height:100%;
        }

        .gantt_grid_scale .gantt_grid_head_cell,
        .gantt_task .gantt_task_scale .gantt_scale_cell {
            font-weight: bold;
            font-size: 14px;
            color: rgba(0, 0, 0, 0.7);
        }

        .resource_marker{
            text-align: center;
        }
        .resource_marker div{
            width: 28px;
            height: 28px;
            line-height: 29px;
            display: inline-block;
            border-radius: 15px;
            color: #FFF;
            margin: 3px;
        }
        .resource_marker.workday_ok div {
            background: #51c185;
        }

        .resource_marker.workday_over div{
            background: #ff8686;
        }

        .owner-label{
            width: 20px;
            height: 20px;
            line-height: 20px;
            font-size: 12px;
            display: inline-block;
            border: 1px solid #cccccc;
            border-radius: 25px;
            background: #e6e6e6;
            color: #6f6f6f;
            margin: 0 3px;
            font-weight: bold;
        }
        .gantt_task_cell.week_end {
            background-color: #EFF5FD;
        }

        .gantt_task_row.gantt_selected .gantt_task_cell.week_end {
            background-color: #F8EC9C;
        }
        .meeting_task {
            border: 2px solid #BFC518;
            color: #6ba8e3;
            background: #F2F67E;
        }

        .meeting_task .gantt_task_progress {
            background: #D9DF29;
        }

        .gantt_cal_larea{
            overflow:visible;
        }
        .gantt_cal_chosen,
        .gantt_cal_chosen select {
            width: 400px;
        }

    </style>
@stop

@section('content_header')
    <h1>Tenders </h1><small>All Published Tenders</small>
@stop

@section('content')
{{--@section('gantt_scripts')--}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{asset('gantt_files/samples/11_resources/common/jquery_multiselect.js')}}"></script>
    {{--    <script src="{{asset('gantt')}}"></script>--}}
    <script src="{{asset('gantt_files/codebase/dhtmlxgantt.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
{{--@stop--}}

<form class="gantt_control">
    <input type="button" value="Zoom In" onclick="zoomIn()">
    <input type="button" value="Zoom Out" onclick="zoomOut()">

    <input type="radio" id="scale1" class="gantt_radio" name="scale" value="day">
    <label for="scale1">Day scale</label>

    <input type="radio" id="scale2" class="gantt_radio" name="scale" value="week">
    <label for="scale2">Week scale</label>

    <input type="radio" id="scale3" class="gantt_radio" name="scale" value="month">
    <label for="scale3">Month scale</label>

    <input type="radio" id="scale4" class="gantt_radio" name="scale" value="quarter">
    <label for="scale4">Quarter scale</label>

    <input type="radio" id="scale5" class="gantt_radio" name="scale" value="year" checked>
    <label for="scale5">Year scale</label>

</form>
<div id="gantt_here"  style='width:100%; height:600px;'></div>
<script>
        {{-- Zoom Configurations --}}
    var zoomConfig = {
            levels: [
                {
                    name:"day",
                    scale_height: 27,
                    min_column_width:80,
                    scales:[
                        {unit: "day", step: 1, format: "%d %M"}
                    ]
                },
                {
                    name:"week",
                    scale_height: 50,
                    min_column_width:50,
                    scales:[
                        {unit: "week", step: 1, format: function (date) {
                                var dateToStr = gantt.date.date_to_str("%d %M");
                                var endDate = gantt.date.add(date, -6, "day");
                                var weekNum = gantt.date.date_to_str("%W")(date);
                                return "#" + weekNum + ", " + dateToStr(date) + " - " + dateToStr(endDate);
                            }},
                        {unit: "day", step: 1, format: "%j %D"}
                    ]
                },
                {
                    name:"month",
                    scale_height: 50,
                    min_column_width:120,
                    scales:[
                        {unit: "month", format: "%F, %Y"},
                        {unit: "week", format: "Week #%W"}
                    ]
                },
                {
                    name:"quarter",
                    height: 50,
                    min_column_width:90,
                    scales:[
                        {unit: "month", step: 1, format: "%M"},
                        {
                            unit: "quarter", step: 1, format: function (date) {
                                var dateToStr = gantt.date.date_to_str("%M");
                                var endDate = gantt.date.add(gantt.date.add(date, 3, "month"), -1, "day");
                                return dateToStr(date) + " - " + dateToStr(endDate);
                            }
                        }
                    ]
                },
                {
                    name:"year",
                    scale_height: 50,
                    min_column_width: 30,
                    scales:[
                        {unit: "year", step: 1, format: "%Y"}
                    ]
                }
            ]
        };

    gantt.ext.zoom.init(zoomConfig);
    gantt.ext.zoom.setLevel("year");
    gantt.ext.zoom.attachEvent("onAfterZoom", function(level, config){
        document.querySelector(".gantt_radio[value='" +config.name+ "']").checked = true;
    });

    gantt.config.work_time = true;

    gantt.config.scale_unit = "day";
    gantt.config.date_scale = "%D, %d";
    gantt.config.min_column_width = 60;
    gantt.config.duration_unit = "day";
    gantt.config.scale_height = 20 * 3;
    gantt.config.row_height = 30;

    var weekScaleTemplate = function (date) {
        var dateToStr = gantt.date.date_to_str("%d %M");
        var weekNum = gantt.date.date_to_str("(week %W)");
        var endDate = gantt.date.add(gantt.date.add(date, 1, "week"), -1, "day");
        return dateToStr(date) + " - " + dateToStr(endDate) + " " + weekNum(date);
    };
    gantt.config.subscales = [
        {unit: "month", step: 1, date: "%F, %Y"},
        // {unit: "week", step: 1, template: weekScaleTemplate}

    ];

    gantt.templates.timeline_cell_class = function (task, date) {
        if (!gantt.isWorkTime(date))
            return "week_end";
        return "";
    };

    gantt.config.columns = [
        {name: "text", tree: true, width: 200, resize: true},
        {name: "start_date", align: "center", width: 80, resize: true},
        {name: "owner", align: "center", width: 75, label: "Owner", template: function (task) {
                if (task.type === gantt.config.types.project) {
                    return "";
                }

                var result = "";
                var store = gantt.getDatastore("resource");
                var owners = task[gantt.config.resource_property];

                if (!owners || !owners.length) {
                    return "Unassigned";
                }

                if(owners.length === 1){
                    return store.getItem(owners[0].text);
                }

                owners.forEach(function(ownerId) {
                    var owner = store.getItem(ownerId);
                    if (!owner)
                        return;
                    result += "<div class='owner-label' title='" + owner.text + "'>" + owner.text.substr(0, 1) + "</div>";

                });

                return result;
            }, resize: true
        },
        {name: "duration", width: 60, align: "center"},
        {name: "add", width: 44}
    ];

    var resourceConfig = {
        columns: [
            {
                name: "name", label: "Name", tree:true, template: function (resource) {
                    return resource.text;
                }
            },
            {
                name: "workload", label: "Workload", template: function (resource) {
                    var tasks;
                    var store = gantt.getDatastore(gantt.config.resource_store),
                        field = gantt.config.resource_property;

                    if(store.hasChild(resource.id)){
                        tasks = gantt.getTaskBy(field, store.getChildren(resource.id));
                    }else{
                        tasks = gantt.getTaskBy(field, resource.id);
                    }

                    var totalDuration = 0;
                    for (var i = 0; i < tasks.length; i++) {
                        totalDuration += tasks[i].duration;
                    }

                    return (totalDuration || 0) * 8 + "h";
                }
            }
        ]
    };

    gantt.templates.resource_cell_class = function(start_date, end_date, resource, tasks){
        var css = [];
        css.push("resource_marker");
        if (tasks.length <= 1) {
            css.push("workday_ok");
        } else {
            css.push("workday_over");
        }
        return css.join(" ");
    };

    gantt.templates.resource_cell_value = function(start_date, end_date, resource, tasks){
        return "<div>" + tasks.length * 8 + "</div>";
    };

    //Meeting Section
    gantt.config.types["meeting"] = "Meeting";
    gantt.locale.labels["type_meeting"] = "Meeting";

    var tender = "{{$tender->id}}";


    gantt.locale.labels.section_owner = "Owner";
    gantt.locale.labels.time_enable_button = 'Schedule';
    gantt.locale.labels.time_disable_button = 'Unschedule';
    gantt.locale.labels.section_template = "More Details";
    gantt.locale.labels.section_tender = "";


    gantt.config.lightbox.sections = [
        {name: "description", height: 38, map_to: "text", type: "textarea", focus: true},
        {name: "owner", height: 22, map_to: "owner_id", type: "select", options: gantt.serverList("people")},
        // {name:"owner",height:25, type:"multiselect", options:gantt.serverList("people"), map_to:"owner_id" },
        {name: "type", type: "typeselect", map_to: "type"},
        {name: "time", type: "duration_optional", map_to: "auto", button: true},
        {name: "template", height: 29, type: "template", map_to: "my_template"},
        {name: "tender", height:1, map_to: "tender_id", type: "radio", options: [{key:tender, label: "{{$tender->name}}"}], default_value: tender },

        {{--{name: "tender_id", map_to: "tender_id", type: "hidden", value: "{{$tender->name}}"}--}}
    ];

    gantt.config.lightbox.milestone_sections =[
        {name: "description", height: 38, map_to: "text", type: "textarea", focus: true},
        {name: "owner", height: 22, map_to: "owner_id", type: "select", options: gantt.serverList("people")},
        {name: "type", type: "typeselect", map_to: "type"},
        {name: "time", type: "duration", map_to: "auto", button: true},
        {name: "template", height: 29, type: "template", map_to: "my_template"},
        {name: "tender", height:1, map_to: "tender_id", type: "radio", options: [{key:tender, label: "{{$tender->name}}"}], default_value: tender },
    ];

    {{--            if({{$tender}})--}}

    gantt.attachEvent("onBeforeLightbox", function (id) {
        var task = gantt.getTask(id);

        task.my_template = "<a href='/user/tender/timeline/task/"+ task.id+"' class='btn btn-primary'> Task Details </a>\n";

        // gantt.config.buttons_left = ["gantt_cancel_btn"];
        // gantt.config.buttons_right = [];

        // task.my_template = "<span id='title1'>Holders: </span>" + task.users + "<span id='title2'>Progress: </span>" + task.progress * 100 + " %";
        return true;
    });

    gantt.templates.task_class = function (start, end, task) {
        if (task.type === gantt.config.types.meeting) {
            return "meeting_task";
        }
        return "";
    };
    gantt.templates.task_text = function (start, end, task) {
        if (task.type === gantt.config.types.meeting) {
            return "Meeting: <b>" + task.text + "</b>";
        }
        return task.text;
    };
    gantt.templates.rightside_text = function (start, end, task) {
        if (task.type === gantt.config.types.milestone) {
            return task.text;
        }
        return "";
    };

    gantt.config.date_format = "%Y-%m-%d %H:%i:%s";
    gantt.config.resource_store = "resource";
    gantt.config.resource_property = "owner_id";
    gantt.config.order_branch = true;
    gantt.config.open_tree_initially = true;
    gantt.config.layout = {
        css: "gantt_container",
        rows: [
            {
                cols: [
                    {view: "grid", group:"grids", scrollY: "scrollVer"},
                    {resizer: true, width: 1},
                    {view: "timeline", scrollX: "scrollHor", scrollY: "scrollVer"},
                    {view: "scrollbar", id: "scrollVer", group:"vertical"}
                ],
                gravity:2
            },
            {resizer: true, width: 1},
            {
                config: resourceConfig,
                cols: [
                    {view: "resourceGrid", group:"grids", width: 435, scrollY: "resourceVScroll" },
                    {resizer: true, width: 1},
                    {view: "resourceTimeline", scrollX: "scrollHor", scrollY: "resourceVScroll"},
                    {view: "scrollbar", id: "resourceVScroll", group:"vertical"}
                ],
                gravity:1
            },
            {view: "scrollbar", id: "scrollHor"}
        ]
    };

    var resourcesStore = gantt.createDatastore({
        name: gantt.config.resource_store,
        type: "treeDatastore",
        initItem: function (item) {
            item.parent = item.parent || gantt.config.root_id;
            item[gantt.config.resource_property] = item.parent;
            item.open = true;
            return item;
        }
    });
    gantt.init("gantt_here");
    {{--gantt.load("{{asset('gantt_files/samples/common/resource_project_multiple_owners.json')}}");--}}
    gantt.load("/api/data/{{$tender->id}}");


    resourcesStore.attachEvent("onParse", function(){
        var people = [];
        resourcesStore.eachItem(function(res){
            if(!resourcesStore.hasChild(res.id)){
                var copy = gantt.copy(res);
                copy.key = res.id;
                copy.label = res.text;
                people.push(copy);
            }
        });
        gantt.updateCollection("people", people);
    });

    function zoomIn(){
        gantt.ext.zoom.zoomIn();
    }
    function zoomOut(){
        gantt.ext.zoom.zoomOut()
    }

    var radios = document.getElementsByName("scale");
    for (var i = 0; i < radios.length; i++) {
        radios[i].onclick = function (event) {
            gantt.ext.zoom.setLevel(event.target.value);
        };
    }

    var dp = new gantt.dataProcessor("/api");
    dp.init(gantt);
    dp.setTransactionMode("REST");

    resourcesStore.parse({!! json_encode($people) !!});
</script>

@stop
