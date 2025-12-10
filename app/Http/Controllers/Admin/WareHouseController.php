<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tenants\WareHouse;
use App\Http\Requests\Admin\WareHouse\StoreWareHouseRequest;
use App\Http\Requests\Admin\WareHouse\UpdateWareHouseRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WareHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.ware-house.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.ware-house.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWareHouseRequest $request)
    {
        $validated =   $request->validated();
        WareHouse::create([
            'name' => $validated['name'],
            'location_id' => $validated['location'],
            'address' => $validated['address'] ?? null,
        ]);
        return redirect()->route('admin.ware-houses.index')->with('success', __('messages.created_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(WareHouse $ware_house)
    {

        $ware_house->load('location:id,name');
        return view('admin.pages.ware-house.show', ['wareHouse' => $ware_house]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WareHouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWareHouseRequest $request, WareHouse $ware_house)
    {

        $validated =   $request->validated();

        $ware_house->fill([
            'name' => $validated['name'],
            'location_id' => $validated['location'],
            'address' => $validated['address'] ?? null,
        ]);

        if ($ware_house->isDirty()) {
            $ware_house->save();



            return redirect()->route('admin.ware-houses.show', ['ware_house' => $ware_house->id])->with('success', __('common.edit_successful'));
        }

        return redirect()->route('admin.ware-houses.show', ['ware_house' => $ware_house->id])->with('info', __('common.edit_unsccessful'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WareHouse $warehouse)
    {
        DB::transaction(function () use ($warehouse) {
            $warehouse->delete();
        });
    }
}
