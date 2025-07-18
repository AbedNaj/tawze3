<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Tenants\Location;
use App\Http\Requests\Admin\Location\StoreLocationRequest;
use App\Http\Requests\Admin\Location\UpdateLocationRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.location.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        $validated = $request->validated();

        Location::create($validated);

        return redirect()->route('admin.locations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return view('admin.pages.location.show', [
            'location' => $location
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $validated = $request->validated();
        $location->fill([
            'name' => $validated['name']
        ]);

        if ($location->isDirty()) {
            $location->save();
            return back()->with('status', 'تم التعديل بنجاح');
        }
        return back()->with('info', 'لم يتم إجراء أي تعديل');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {


        if ($location->delete()) {
            return redirect()->route('admin.locations.index')->with([
                'message' => 'Product Type deleted successfully.',
                'alert-type' => 'success'
            ]);
        }

        return back()->with([
            'message' => 'Failed to delete Product Type.',
            'alert-type' => 'error'
        ]);
    }
}
