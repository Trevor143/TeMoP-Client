<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Tender;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $task = new Task();

        $task->text = $request->text;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;
        $task->tender_id = $request->tender_id;
        $task->type = $request->type;
        $task->owners = $request->owner_id;

        $task->save();
        return response()->json([
            "action"=> "inserted",
            "tid" => $task->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        $tender = Tender::find($id);
//        $people = BackpackUser::all('id','name')->map(function ($items){
//            $data['id'] = $items->id;
//            $data['text'] = $items->name;
//            return $data;
//        });
////        $tasks = $tender->tasks;
////        dd($tender);
//        return view('vendor.backpack.timelines.gantt', compact('tender', 'people'));
//    }

    public function show($id)
    {
        $task = Task::find($id);
//        dd($task->user->name);

        return view('admin.timeline.task', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $task->text = $request->text;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->tender_id = $request->tender_id;
        $task->parent = $request->parent;
        $task->type = $request->type;
        $task->owners = $request->owner_id;

        $task->save();

        return response()->json([
            "action"=> "updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task = Task::find($task->id);
        $task->delete();

        return response()->json([
            "action"=> "deleted"
        ]);    }
}
