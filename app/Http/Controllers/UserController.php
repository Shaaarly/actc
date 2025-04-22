<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Name;
use App\Models\Address;
use App\Models\Role;
use App\Models\Plate;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Services\UserService;

use \Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct (
        private UserService $user_service
    ) {

    }

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
        $data = $request->validated();

        $user = new User();
        $this->user_service->createOrUpdateUser($user, $data);

        if(isset($data['plates'])){
            $this->user_service->syncPlates($user, $data['plates']);
        }
        $user->save();
        
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
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {

        $data = $request->validated();

        $this->user_service->createOrUpdateUser($user, $data);

        if(isset($data['plates'])){
            $this->user_service->syncPlates($user, $data['plates']);
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

    public function profile()
    {
        return $this->show(Auth::user());
    }
}
