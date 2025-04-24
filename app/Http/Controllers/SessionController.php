<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $sessions = DB::table('sessions')
            ->where('user_id', $user->id)
            ->orderBy('last_activity', 'desc')
            ->get();

        return view('users.tabs.sessions', compact('sessions'));
    }

    public function destroy($id)
    {
        DB::table('sessions')->where('id', $id)->delete();

        return back()->with('success', 'Sesión cerrada correctamente.');
    }
}
