<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lease;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PaymentType;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Recupera los parámetros de filtro y orden de la request
        $sort_by = $request->input('sort_by');
        $property_type_id = $request->input('property_type_id');

        // Inicia la consulta con eager loading de las relaciones necesarias
        $query = Lease::with([
            'property.address',
            'property.type',
            'client.name',
        ]);

        // Filtra por tipo de propiedad si se ha seleccionado uno
        if ($property_type_id) {
            $query->whereHas('property', function ($q) use ($property_type_id) {
                $q->where('property_type_id', $property_type_id);
            });
        }

        // Aplica ordenación basada en el parámetro sort_by
        if ($sort_by) {
            switch ($sort_by) {
                case 'start_lease_asc':
                    $query->orderBy('start_lease', 'asc');
                    break;
                case 'start_lease_desc':
                    $query->orderBy('start_lease', 'desc');
                    break;
                case 'ending_lease_asc':
                    $query->orderBy('ending_lease', 'asc');
                    break;
                case 'ending_lease_desc':
                    $query->orderBy('ending_lease', 'desc');
                    break;
            }
        } else {
            // Orden por defecto: por fecha de inicio en orden descendente
            $query->orderBy('start_lease', 'desc');
        }

        $leases = $query->get();

        // Para poblar el dropdown de tipos de propiedad en el filtro
        $propertyTypes = PropertyType::all();

        return view('leases.index', compact('leases', 'propertyTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = User::where('role_id', 1)->get();
        $owners = User::where('role_id', 2)->get();
        $properties = Property::all();
        $paymentTypes = PaymentType::all();
        return view('leases.create', compact('clients', 'owners', 'properties', 'paymentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $lease = new Lease();

        // Service

        $lease->save();

        return redirect()->route('leases.show', $lease)->with('success', 'Alquiler dado de alta correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lease $lease)
    {
        return view('leases.show', compact('lease'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lease $lease)
    {
        $clients = User::where('role_id', 1)->get();
        $owners = User::where('role_id', 2)->get();
        $properties = Property::all();
        $paymentTypes = PaymentType::all();
        return view('leases.edit', compact('lease', 'clients', 'owners', 'properties', 'paymentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lease $lease)
    {
        $data = $request->all();

        // Service

        return redirect()->route('leases.show', $lease)->with('success', 'Alquiler modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $lease)
    {
        $lease->delete();
        return redirect()->route('leases.index')->with('success', 'Contrato finalizado correctamente');
    }
}
