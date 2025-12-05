<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Employee\StoreEmployeeRequest;


use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\UpdateEmployeeUserRequest;
use App\Models\Tenants\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $employeeUser)
    {


        $employeeUser->load('employee:user_id,name');

        return view('admin.pages.employeeUser.show', ['employeeUser' => $employeeUser]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $employeeUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeUserRequest $request, User $employeeUser)
    {
        $validated = $request->validated();

        $employeeUser->fill(
            ['email' => $validated['user_name']]
        );

        if ($employeeUser->isDirty()) {
            $employeeUser->save();

            return back()->with('status', 'تم التعديل بنجاح');
        }
        return back()->with('info', 'لم يتم إجراء أي تعديل');
    }
    public function updatePassword(Request $request, User $employeeUser)
    {
        $validated = $request->validate(
            [
                'password' => ['required', Password::min(6)]
            ]
        );

        $employeeUser->update(
            [
                'password' => Hash::make($validated['password'])
            ]
        );
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $employeeUser)
    {
        //
    }
}
