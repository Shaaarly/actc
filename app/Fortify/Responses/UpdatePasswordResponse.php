<?php

namespace App\Fortify\Responses;

use Laravel\Fortify\Contracts\UpdateUserPasswordResponse;
use Illuminate\Http\Request;

class UpdatePasswordResponse implements UpdateUserPasswordResponse
{
    public function toResponse($request)
    {
        return redirect()
            ->route('configuracion', ['tab' => 'security'])
            ->with('status', 'password-updated');
    }
}
