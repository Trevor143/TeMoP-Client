<?php

namespace App\Http\Controllers;

use App\Models\Bidder;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.company');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.company');
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

        $company = Company::create($request->all());

        $user = Bidder::find(auth()->user()->id);
        $user->admin = 1;

        $user->company_id = $company->id;
        $user->save();

        return redirect()->route('tender.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company)
    {
        $update = Company::find($company);

        $update->name = $request->name;
        $update->yearFounded = $request->yearFounded;
        $update->type = $request->type;
        $update->mobile = $request->mobile;
        $update->email = $request->email;

        $update->save();

        toastSuccess('Company details successfulty updated');

        return redirect()->route('account.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

}
