<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('super-admin.pages.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super-admin.pages.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|string|max:255|unique:tenants,id',
            'name' => 'required|string|max:255',
        ]);


        $tenant = Tenant::create(['id' => $validated['tenant_id']]);


        $tenant->domains()->create([
            'domain' => $validated['tenant_id'] . '.' . env('APP_DOMAIN', 'tawze3.test'),
        ]);


        tenancy()->initialize($tenant);


        $adminUser =   \App\Models\Tenants\User::create([
            'name' => $validated['name'],
            'email' => $validated['tenant_id'] . '@' . env('APP_DOMAIN', 'tawze3.test'),
            'password' => bcrypt('123'),
        ]);

        $adminUser->assignRole('admin');


        tenancy()->end();


        return redirect()->route('company.index')
            ->with('success', 'تم إنشاء الشركة بنجاح، مع حساب افتراضي للمسؤول.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
