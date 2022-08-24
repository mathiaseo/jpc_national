<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocaliteStoreRequest;
use App\Http\Requests\LocaliteUpdateRequest;
use App\Models\Localite;
use Illuminate\Http\Request;

class LocaliteController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $localites = Localite::all();

        return view('localite.index', compact('localites'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('localite.create');
    }

    /**
     * @param \App\Http\Requests\LocaliteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocaliteStoreRequest $request)
    {
        $localite = Localite::create($request->validated());

        $request->session()->flash('localite.id', $localite->id);

        return redirect()->route('localite.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Localite $localite
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Localite $localite)
    {
        return view('localite.show', compact('localite'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Localite $localite
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Localite $localite)
    {
        return view('localite.edit', compact('localite'));
    }

    /**
     * @param \App\Http\Requests\LocaliteUpdateRequest $request
     * @param \App\Models\Localite $localite
     * @return \Illuminate\Http\Response
     */
    public function update(LocaliteUpdateRequest $request, Localite $localite)
    {
        $localite->update($request->validated());

        $request->session()->flash('localite.id', $localite->id);

        return redirect()->route('localite.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Localite $localite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Localite $localite)
    {
        $localite->delete();

        return redirect()->route('localite.index');
    }
}
