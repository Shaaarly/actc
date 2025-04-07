<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\PropertyRequest;
use App\Services\PropertyService;

class PropertyController extends Controller
{
    public function __construct (
        private PropertyService $property_service
    ) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::all();
        $groupedProperties = $properties->groupBy(function ($property) {
            return $property->type->property_type;
        });
        return view('properties.index', compact('groupedProperties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $propertyTypes = PropertyType::all();
        $propertyOwners= User::where('role_id', 2)->get();
        return view('properties.create', compact('propertyTypes', 'propertyOwners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {
        // $data = $request->all();
        $data = $request->validated();

        $property = new Property();
    
        $this->property_service->createOrUpdateProperty($property, $data);

        return redirect()->route('properties.show', $property)->with('success', 'Propiedad creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $propertyTypes = PropertyType::all();
        $propertyOwners= User::where('role_id', 2)->get();
        return view('properties.edit', compact('property', 'propertyTypes', 'propertyOwners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $data = $request->validated();
        // dd($data);
        // $data = $request->all();
        
        $this->property_service->createOrUpdateProperty($property, $data);

        return redirect()->route('properties.show', $property)->with('success', 'Propiedad actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Propiedad eliminada correctamente.');
    }
}
