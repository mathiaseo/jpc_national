<?php

namespace App\Http\Controllers;

use App\Http\Requests\SecteurStoreRequest;
use App\Http\Requests\SecteurUpdateRequest;
use App\Models\Secteur;
use Illuminate\Http\Request;

class SecteurController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $secteurs = Secteur::all();

        return view('secteur.index', compact('secteurs'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('secteur.create');
    }

    /**
     * @param \App\Http\Requests\SecteurStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SecteurStoreRequest $request)
    {
        $secteur = Secteur::create($request->validated());

        $request->session()->flash('secteur.id', $secteur->id);

        return redirect()->route('secteur.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Secteur $secteur
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Secteur $secteur)
    {
        return view('secteur.show', compact('secteur'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Secteur $secteur
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Secteur $secteur)
    {
        return view('secteur.edit', compact('secteur'));
    }

    /**
     * @param \App\Http\Requests\SecteurUpdateRequest $request
     * @param \App\Models\Secteur $secteur
     * @return \Illuminate\Http\Response
     */
    public function update(SecteurUpdateRequest $request, Secteur $secteur)
    {
        $secteur->update($request->validated());

        $request->session()->flash('secteur.id', $secteur->id);

        return redirect()->route('secteur.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Secteur $secteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Secteur $secteur)
    {
        $secteur->delete();

        return redirect()->route('secteur.index');
    }
}
