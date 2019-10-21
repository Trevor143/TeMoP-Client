<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\File;
use App\Http\Requests\FileUploadRequest;
use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File as StoreFile;
use Illuminate\Http\UploadedFile as UploadFile;
use Illuminate\Support\Facades\Validator;

class BidController extends Controller
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

    public function bid($id)
    {
        $tender = Tender::findOrFail($id);
//        dd($tender->requiredDocs);
        return view('admin.tender.bid.create', compact('tender'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('')
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $brequest
     * @param FileUploadRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        dd($request->all());
        $bid = Bid::create($request->except('filename', 'file'));
        $files = $request->input('filename');

        foreach ($files as $key => $value){

            $validator = Validator::make($request->only('file' . $key), [
                'file' . $key => 'required|file'
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $path = $request->file('file'.$key)->storeAs('bids' , $request->file('file'.$key)->getClientOriginalName());
//            dd($path);
            $bid->files()->create(['filename'=> $value,
                                        'fileurl' => $path]);
        }
        return redirect('user/tender');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function show(Bid $bid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bidd = Bid::find($id);

        $tender = Tender::findOrFail($bidd->tender_id);
        dd($bidd->files);

        return view('admin.tender.bid.edit', compact('bidd', 'tender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bid $bid)
    {
        $files = $request->input('filename');

//        dd($files);
        foreach ($files as $key => $value){

            $validator = Validator::make($request->only('fileurl' . $key), [
                'fileurl'.$key => 'required|file'
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            Storage::delete($request->file('oldfile'.$key));
            $path = $request->file('fileurl'.$key)->storeAs('bids' , $request->file('fileurl'.$key)->getClientOriginalName());
//            dd($path);
            $bid->files()->update(['filename'=> $value,
                'fileurl' => $path]);
        }
        return redirect('user/tender');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $bid)
    {
        //
    }
}
