<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Name;
use App\Models\Address;
use App\Models\Role;
use App\Models\Plate;
use Illuminate\Http\Request;
use Illuminate\Http\Request\UserRequest;
use \Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function clientIndex()
    {
        $users = User::where('role_id', 1)->get();
        return view('clients.index', compact('users'));
    }
    
    public function ownerIndex()
    {
        $users = User::where('role_id', 2)->get();
        return view('owners.index', compact('users'));
    }
    
    public function index() 
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // Obetener solo los datos que han sido validados
        $data = $request->validated();

        $name = Name::create([
            'name'           => $data['name'],
            'surname_first'  => $data['surname_first'],
            'surname_second' => $data['surname_second'] ?? null,
        ]);

        $user = new User();
        $user->name_id = $name->id;
        $user->role_id = 1;
        $user->dni = $data['dni'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->description = $data['description'];
        $user->save();

        Address::create([
            'addressable_type' => 'user',
            'addressable_id'   => $user->id,
            'country'          => $data['country'],
            'province'         => $data['province'],
            'city'             => $data['city'],
            'postal_code'      => $data['postal_code'],
            'street_name'      => $data['street_name'],
            'entrance_number'  => $data['entrance_number'],
            'floor'            => $data['floor'],
            'block'            => $data['block'] ?? null,
            'apartment_number' => $data['apartment_number'],
        ]);

        if (!empty($data['plate'])) {
            Plate::create([
                'user_id' => $user->id,
                'plate'   => $data['plate'],
            ]);
        }

        return redirect()->route('users.show', $user)->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if ($user->role_id == 1) {
            return view('clients.edit', compact('user'));
        } elseif ($user->role_id == 2) {
            return view('owners.edit', compact('user'));
        } else {
            return redirect()->route('users.index')->with('error', 'Rol no permitido para edición.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {

        $data = $request->validated();

        $user->dni   = $data['dni'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->description = $data['description'];
        $user->save();

        $user->name->update([
            'name'           => $data['name'],
            'surname_first'  => $data['surname_first'],
            'surname_second' => $data['surname_second'] ?? null,
        ]);

        if ($user->address) {
            $user->address->update([
                'country'          => $data['country'],
                'province'         => $data['province'],
                'city'             => $data['city'],
                'postal_code'      => $data['postal_code'],
                'street_name'      => $data['street_name'],
                'entrance_number'  => $data['entrance_number'],
                'floor'            => $data['floor'],
                'block'            => $data['block'] ?? null,
                'apartment_number' => $data['apartment_number'],
            ]);
        } else {
            Address::create([
                'addressable_type' => 'user',
                'addressable_id'   => $user->id,
                'country'          => $data['country'],
                'province'         => $data['province'],
                'city'             => $data['city'],
                'postal_code'      => $data['postal_code'],
                'street_name'      => $data['street_name'],
                'entrance_number'  => $data['entrance_number'],
                'floor'            => $data['floor'],
                'block'            => $data['block'] ?? null,
                'apartment_number' => $data['apartment_number'],
            ]);
        }

        if (!empty($data['plate'])) {
            Plate::updateOrCreate(
                ['user_id' => $user->id],
                ['plate' => $data['plate']]
            );
        }

        return redirect()->route('users.show', $user)->with('success', 'Usuario actualizado correctamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
