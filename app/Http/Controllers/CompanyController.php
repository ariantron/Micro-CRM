<?php

namespace App\Http\Controllers;

use App\Funcs\Pager;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $pageSize = 10;
        $companies = Company::orderBy('id', 'DESC')->paginate($pageSize)->withQueryString();
        $pager = new Pager(Company::count(), $pageSize);
        return view('Companies', compact('companies', 'pager'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyRequest $request
     * @return RedirectResponse
     */
    public function store(CompanyRequest $request)
    {
        $validated = $request->validated();
        $company = Company::create($validated);
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoName = 'logo-company-' . $company->id . '.' . $logoFile->getClientOriginalExtension();
            $logoDir = 'company-logos';
            $logoPath = $logoDir . '/' . $logoName;
            Storage::putFileAs('public/' . $logoDir, $logoFile, $logoName);
            $company->logo_path = $logoPath;
            $company->save();
        }
        return redirect()->route('companies.index')->with('success', true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('CompanyCreate');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Application|Factory|View
     */
    public function edit(Company $company)
    {
        return view('CompanyEdit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $validated = $request->validated();
        $company = Company::updateOrCreate(['id'=>$company->id],$validated);
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoName = 'logo-company-' . $company->id . '.' . $logoFile->getClientOriginalExtension();
            $logoDir = 'company-logos';
            $logoPath = $logoDir . '/' . $logoName;
            Storage::putFileAs('public/' . $logoDir, $logoFile, $logoName);
            $company->logo_path = $logoPath;
            $company->save();
        }
        return redirect()->back()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company)
    {
        Company::destroy($company->id);
        return redirect()->back()->with('deleted', true);
    }
}
