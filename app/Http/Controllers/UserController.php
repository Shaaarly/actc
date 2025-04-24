<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Name;
use App\Models\Address;
use App\Models\Role;
use App\Models\Plate;
use Illuminate\Http\Request;

use App\Http\Requests\UpdateNotificationPreferencesRequest;
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
        return view('users.edit', compact('user'))->with('isProfile', false);
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
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'))->with('isProfile', true);
    }

    public function updateProfile(UserRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        $this->user_service->createOrUpdateUser($user, $data);

        if(isset($data['plates'])) {
            $this->user_service->syncPlates($user, $data['plates']);
        }

        return redirect()->route('profile')->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroyProfile()
    {
        $user = Auth::user();

        Auth::logout();

        $user->delete();

        return redirect('/')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
    }


    public function settings($tab = 'general')
    {
        $availableTabs = ['general', 'security', 'notifications'];
    
        if (!in_array($tab, $availableTabs)) {
            abort(404);
        }
    
        $user = Auth::user(); // Puedes cargar más relaciones si las usas en la vista
    
        $sessions = \DB::table('sessions')
            ->where('user_id', $user->id)
            ->orderBy('last_activity', 'desc')
            ->get();
    
        return view('users.settings', compact('tab', 'user', 'sessions'));

    }

    public function updateNotifications(UpdateNotificationPreferencesRequest $request)
    {
        $user = Auth::user();

        $validated = $request->validated();

        $user->notifications = array_map(fn($val) => (bool) $val, $validated['notifications'] ?? []);
        $user->save();

        return back()->with('success', 'Preferencias de notificación actualizadas.');
    }


    

}
