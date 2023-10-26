<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Dietary;
use Illuminate\Http\Request;
use App\Models\Employee;


class EmployeeControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employees.index', [
            'employees' => Employee::paginate(10)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allDietaryPreferences = Dietary::all();
        $allCompanies = Company::all();
        return view('employees.create', [
            'dietaryPreferences' => $allDietaryPreferences,
            'allCompanies' => $allCompanies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_id' => 'required',
            'email' => 'required|email|unique:employees',
            'phone.*' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'dietary' => 'required|array'
        ]);

        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'phone' => implode(',', $request->input('phone')),
        ]);

        $employee->dietaryPreferences()->attach($request->input('dietary'));

        return redirect(route('employees.index'));
    }



    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {

        $employee->load('dietaryPreferences', 'company');

        return view('employees.show',[
            'employee'=>$employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Employee $employee)
    {
        $employee->load('dietaryPreferences', 'company');

        $allDietaryPreferences = Dietary::all();
        $allCompanies = Company::all();

        return view('employees.edit', [
            'employee' => $employee,
            'dietaryPreferences' => $allDietaryPreferences,
            'allCompanies' => $allCompanies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required', // Zakładam, że to jest pole związane z relacją do firmy (company)
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone.*' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'dietary' => 'required|array', // Zakładam, że to jest pole związane z relacją do preferencji żywieniowych (dietary)
        ]);


        // Aktualizacja atrybutów modelu na podstawie danych z formularza
        $employee->update($request->only([
            'first_name',
            'last_name',
            'email',
            'company_id',
            'phone' => implode(',', $request->input('phone')),
        ]));

        $phoneNumbers = array_map(function ($phoneNumber) {
            return ['number' => $phoneNumber];
        }, $request->input('phone'));

        $employee->update(['phone'=>implode(',', $request->input('phone'))]);

        // Aktualizuj preferencje żywieniowe
        $employee->dietaryPreferences()->sync($request->input('dietary'));

        return redirect(route('employees.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect(route('employees.index'));
    }
}
