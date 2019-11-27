<?php

namespace App\Http\Controllers;

use App\Link;
use App\Models\Organization;
use App\Models\Tender;
use App\Task;
use Illuminate\Http\Request;

class GanttController extends Controller
{
    public function show($id)
    {
        $tender = Tender::find($id);

        $people = $tender->user->map(function ($items){
            $data['id'] = $items->id;
            $data['text'] = $items->name;
            return $data;
        });
        return view('admin.timeline.show', compact('people', 'tender'));
    }

    public function get($id){
        $tender = Tender::find($id);
//        $tasks = Task::where('tender_id', $id)->get();
        $tasks = new Task();
        $links = new Link();
//        $people = new BackpackUser();

        return response()->json([
            "data" => $tender->tasks,
            "links" => $links->all(),
//            "people" => $people->all('id','name')->map(function ($items){
//                $data['id'] = $items->id;
//                $data['text'] = $items->name;
//                return $data;
//            }),
//            "data" => $tasks->where('tender_id', $id)->get(),
        ]);
    }
}
