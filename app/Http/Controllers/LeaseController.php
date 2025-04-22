<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lease;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PaymentType;

use App\Services\LeaseService;

class LeaseController extends Controller
{

    public function __construct (
        private LeaseService $lease_service
    ) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_by = $request->input('sort_by');
        $property_type_id = $request->input('property_type_id');
        $active = $request->input('active');
        $client_id = $request->input('client_id');

        $query = Lease::with([
            'property.address',
            'property.type',
            'client.name',
        ]);

        if ($property_type_id) {
            $query->whereHas('property', function ($q) use ($property_type_id) {
                $q->where('property_type_id', $property_type_id);
            });
        }

        if (!is_null($active)) {
            $query->where('active', $active);
        }

        if ($client_id) {
            $query->where('client_id', $client_id);
        }

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
            $query->orderBy('start_lease', 'desc');
        }

        $leases = $query->get();
        $propertyTypes = PropertyType::all();
        $clients = User::with('name')->where('role_id', 1)->get();

        return view('leases.index', compact('leases', 'propertyTypes', 'clients'));

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

        $this->lease_service->createOrUpdateLease($lease, $data);

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

        $this->lease_service->createOrUpdateLease($lease, $data);

        $lease->save();

        return redirect()->route('leases.show', $lease)->with('success', 'Alquiler modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $lease)
    {
        $lease->active = 0;
        $lease->delete();
        return redirect()->route('leases.index')->with('success', 'Contrato finalizado correctamente');
    }
}
