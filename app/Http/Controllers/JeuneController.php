<?php

namespace App\Http\Controllers;

use App\Http\Requests\JeuneStoreRequest;
use App\Http\Requests\JeuneUpdateRequest;
use App\Models\Jeune;
use Illuminate\Http\Request;

class JeuneController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jeunes = Jeune::all();

        return view('jeune.index', compact('jeunes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('jeune.create');
    }

    /**
     * @param \App\Http\Requests\JeuneStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JeuneStoreRequest $request)
    {
        $jeune = Jeune::create($request->validated());

        $request->session()->flash('jeune.id', $jeune->id);

        return redirect()->route('jeune.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Jeune $jeune
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Jeune $jeune)
    {
        return view('jeune.show', compact('jeune'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Jeune $jeune
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Jeune $jeune)
    {
        return view('jeune.edit', compact('jeune'));
    }

    /**
     * @param \App\Http\Requests\JeuneUpdateRequest $request
     * @param \App\Models\Jeune $jeune
     * @return \Illuminate\Http\Response
     */
    public function update(JeuneUpdateRequest $request, Jeune $jeune)
    {
        $jeune->update($request->validated());

        $request->session()->flash('jeune.id', $jeune->id);

        return redirect()->route('jeune.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Jeune $jeune
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Jeune $jeune)
    {
        $jeune->delete();

        return redirect()->route('jeune.index');
    }
}
