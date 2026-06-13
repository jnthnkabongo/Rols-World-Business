<?php

namespace App\Http\Controllers;

use App\Http\Requests\Credentials;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // User::create([
        //     'name' => 'Jonathan kabongo',
        //     'email' => 'jnthnkabongo@gmail.com',
        //     'role_id' => 1,
        //     'password' => Hash::make('1234567'),

        // ]);

        return view('auth');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Credentials $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $userId = Auth::id();
            DB::table('users')->where('id', $userId)
            ->update(['last_login' => now()]);
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))->with('Session', 'Connexion reussie');
        }
        return redirect()->route('')->withErrors(['Error' => 'Identifiants invalides'])->onlyInput('email');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
