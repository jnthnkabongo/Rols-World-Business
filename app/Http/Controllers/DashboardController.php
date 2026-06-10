<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard');
    }

    public function roles()
    {
        $liste_roles = Roles::paginate(10);
        return view('pages.liste-roles', compact('liste_roles'));
    }

    public function AjouterRole($)
    {

        return view('pages.liste-roles');
    }

    public function utilisateurs()
    {
        return view('pages.liste-utilisateurs');
    }

    public function fournisseurs()
    {
        return view('pages.liste-fournisseurs');
    }

    public function produits()
    {
        return view('pages.liste-produits');
    }

    public function ventes()
    {
        return view('pages.liste-ventes');
    }

    public function remises()
    {
        return view('pages.liste-remises');
    }

    public function rapports(){
        return view('pages.rapport-page');
    }

    public function historiques()
    {
        return view('pages.historiques');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
