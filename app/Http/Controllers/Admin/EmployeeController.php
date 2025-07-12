<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Employee;
use App\Http\Requests\Admin\Employee\StoreEmployeeRequest;
use App\Http\Requests\Admin\Employee\UpdateEmployeeRequest;
use App\Models\Tenants\EmployeeUser;
use App\Models\Tenants\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();

        $user = EmployeeUser::create(
            [
                'user_name' => $validated['user_name'],
                'password' => Hash::make('123'),
            ]
        );

        $user->assignRole('employee');
        Employee::create(
            [
                'employee_user_id' => $user->id,
                'name' => $validated['name'],
                'phone' => $validated['phone'],
            ]
        );

        return redirect()->route('admin.employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {

        return view('admin.pages.employee.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();

        $employee->fill(
            [
                'name' => $validated['name'],
                'phone' => $validated['phone']
            ]
        );


        if ($employee->isDirty()) {
            $employee->save();

            return back()->with('status', 'تم التعديل بنجاح');
        }
        return back()->with('info', 'لم يتم إجراء أي تعديل');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
