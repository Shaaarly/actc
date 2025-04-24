<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Lease;

class LeaseService {


    public function __construct() {

    }

    public function activeLeases() {
        return Lease::where('active', true);
    }

    public function endedLeases() {
        return Lease::where('active', false);
    }

    public function relatedLeases() {
        $original = $this->original_lease_id ? $this->originalLease : $this;

        return Lease::where('original_lease_id', $original->id)
                    ->orWhere('id', $original->id)
                    ->orderBy('start_lease')
                    ->get();
    }

    public function createOrUpdateLease($lease, $data) {

        
        if(!isset($lease)) {
            $lease = new Lease();
        }
        
        $lease->client_id = $data['client'];
        $lease->owner_id = $data['owner'];
        $lease->property_id = $data['property'];
        $lease->value = $data['value'];
        $lease->payment_type_id = $data['payment_type'];
        $lease->start_lease = $data['start_date'];
        $lease->ending_lease = $data['ending_date'];
        $lease->keys_returned = 0;
        $lease->remote_returned = 0;
        
        $lease->save();
    }

    public function getFilteredLeases(Request $request)
    {
        $query = Lease::with([
            'property.address',
            'property.type',
            'client.name',
        ]);

        $this->applyPropertyTypeFilter($query, $request->input('property_type_id'));
        $this->applyActiveFilter($query, $request->input('active'));
        $this->applyClientFilter($query, $request->input('client_id'));
        $this->applySort($query, $request->input('sort_by'));

        return $query->get();
    }

    private function applyPropertyTypeFilter($query, $property_type_id)
    {
        if ($property_type_id) {
            $query->whereHas('property', function ($q) use ($property_type_id) {
                $q->where('property_type_id', $property_type_id);
            });
        }
    }

    private function applyActiveFilter($query, $active)
    {
        if (!is_null($active)) {
            $query->where('active', $active);
        }
    }

    private function applyClientFilter($query, $client_id)
    {
        if ($client_id) {
            $query->where('client_id', $client_id);
        }
    }

    private function applySort($query, $sort_by)
    {
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
    }
}