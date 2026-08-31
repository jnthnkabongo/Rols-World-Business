<?php

namespace App\Http\Controllers;

use App\Models\Dettes;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class DettesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liste_dettes = Dettes::orderBy('id', 'desc')->paginate(10);
        $somme_dettes_aujourd_hui = Dettes::whereDate('created_at', Carbon::today())->count('id');
        $somme_toutes_dettes = Dettes::count('id');
        $somme_dettes_en_attente = Dettes::sum('reste_a_payer');
        $somme_dettes_payer = Dettes::sum('montant_payer');
        return view('pages.liste-dettes', compact('liste_dettes','somme_dettes_aujourd_hui','somme_dettes_en_attente', 'somme_dettes_payer','somme_toutes_dettes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'creancier' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'montant_payer' => 'required|numeric|min:0',
            'date_echeance' => 'required|date',
            'statut' => 'required|string|max:50',
            'motif' => 'required|string|max:255',
        ]);

        $validated['montant_payer'] = min((float) $validated['montant'], (float) $validated['montant_payer']);
        $validated['reste_a_payer'] = max(0, (float) $validated['montant'] - (float) $validated['montant_payer']);
        $validated['statut'] = $validated['reste_a_payer'] <= 0 ? 'payée' : (($validated['montant_payer'] > 0) ? 'partiellement payée' : 'en attente');

        Dettes::create($validated);

        return redirect()->route('liste-dettes')->with('success', 'Dette ajoutée avec succès.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dette = Dettes::findOrFail($id);

        $validated = $request->validate([
            'creancier' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'montant_payer' => 'required|numeric|min:0',
            'date_echeance' => 'required|date',
            'statut' => 'required|string|max:50',
            'motif' => 'required|string|max:255',
        ]);

        $validated['montant_payer'] = min((float) $validated['montant'], (float) $validated['montant_payer']);
        $validated['reste_a_payer'] = max(0, (float) $validated['montant'] - (float) $validated['montant_payer']);
        $validated['statut'] = $validated['reste_a_payer'] <= 0 ? 'payée' : (($validated['montant_payer'] > 0) ? 'partiellement payée' : 'en attente');

        $dette->update($validated);

        return redirect()->route('liste-dettes')->with('success', 'Dette modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dette = Dettes::findOrFail($id);
        $dette->delete();

        return redirect()->route('liste-dettes')->with('success', 'Dette supprimée avec succès.');
    }

    public function payer(Request $request, string $id)
    {
        $dette = Dettes::findOrFail($id);

        $validated = $request->validate([
            'montant_payer' => ['required', 'numeric', 'min:0.01', function ($attribute, $value, $fail) use ($dette) {
                $reste = max(0, (float) $dette->montant - (float) $dette->montant_payer);
                if ((float) $value > $reste) {
                    $fail('Le montant payé ne peut pas dépasser le reste à payer.');
                }
            }],
        ]);

        $dette->montant_payer = min((float) $dette->montant, (float) $dette->montant_payer + (float) $validated['montant_payer']);
        $dette->reste_a_payer = max(0, (float) $dette->montant - (float) $dette->montant_payer);
        $dette->statut = $dette->reste_a_payer <= 0 ? 'payée' : (($dette->montant_payer > 0) ? 'partiellement payée' : 'en attente');
        $dette->save();

        return redirect()->route('liste-dettes')->with('success', 'Paiement enregistré avec succès.');
    }
}
