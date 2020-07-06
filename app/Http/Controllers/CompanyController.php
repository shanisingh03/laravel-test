<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use League\CommonMark\Inline\Element\Image;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with('company')->paginate(10);
        return view('company.index')->with(['companies'=>$companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        if ($request->hasFile('logo')) {
            $image      = $request->file('logo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put($fileName, File::get($image), 'public');
        }else{
            $fileName = '';
        }

        $data = $request->except('_token');
        $data['logo'] = $fileName;

        Company::create($data);

        return redirect()->route('companies.index')->with('status','Company Created Successfully');
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
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit')->with(['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        if ($request->hasFile('logo')) {
            $image      = $request->file('logo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put($fileName, File::get($image), 'public');
        }else{
            $fileName = $company->logo;
        }

        $data = $request->except('_token');
        $data['logo'] = $fileName;

        Company::find($company->id)->update($data);

        return redirect()->route('companies.index')->with('status','Company Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        Company::whereId($company->id)->delete();
        return redirect()->route('companies.index')->with('status','Company Deleted Successfully');
    }
}
