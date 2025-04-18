<?php

namespace App\Services;
use App\Models\Lease;

class LeaseService {


    public function __construct() {

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
}