<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lease;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PaymentType;

use App\Services\LeaseService;
use App\Services\UserService;
use App\Services\PropertyService;

use Illuminate\Support\Facades\Auth;

class LeaseController extends Controller
{

    public function __construct (
        private LeaseService $lease_service,
        private UserService $user_service,
        private PropertyService $property_service,
    ) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $leases = $this->lease_service->getFilteredLeases($request);
        $propertyTypes = $this->property_service->getPropertyTypes();
        $clients = $this->user_service->getConfirmedClients();

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

    public function leased() {
        $leases = Auth::user()->leasesAsClient;

        return view('users.leases', compact('leases'));
    }
}
