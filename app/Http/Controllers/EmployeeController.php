<?php

namespace App\Http\Controllers;

use App\Funcs\Pager;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $pageSize = 10;
        $employees = Employee::orderBy('id','DESC')->paginate($pageSize)->withQueryString();
        $pager = new Pager(Employee::count(), $pageSize);
        return view('Employees', compact('employees', 'pager'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $request
     * @return RedirectResponse
     */
    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();
        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('EmployeeCreate');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return Application|Factory|View
     */
    public function edit(Employee $employee)
    {
        return view('EmployeeEdit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();
        Employee::updateOrCreate(['id' => $employee->id], $validated);
        return redirect()->back()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function destroy(Employee $employee)
    {
        Employee::destroy($employee->id);
        return redirect()->back()->with('deleted', true);
    }
}
