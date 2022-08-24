<?php

namespace App\Http\Controllers;

use App\Http\Requests\CirconscriptionStoreRequest;
use App\Http\Requests\CirconscriptionUpdateRequest;
use App\Models\Circonscription;
use Illuminate\Http\Request;

class CirconscriptionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $circonscriptions = Circonscription::all();

        return view('circonscription.index', compact('circonscriptions'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('circonscription.create');
    }

    /**
     * @param \App\Http\Requests\CirconscriptionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CirconscriptionStoreRequest $request)
    {
        $circonscription = Circonscription::create($request->validated());

        $request->session()->flash('circonscription.id', $circonscription->id);

        return redirect()->route('circonscription.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Circonscription $circonscription
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Circonscription $circonscription)
    {
        return view('circonscription.show', compact('circonscription'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Circonscription $circonscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Circonscription $circonscription)
    {
        return view('circonscription.edit', compact('circonscription'));
    }

    /**
     * @param \App\Http\Requests\CirconscriptionUpdateRequest $request
     * @param \App\Models\Circonscription $circonscription
     * @return \Illuminate\Http\Response
     */
    public function update(CirconscriptionUpdateRequest $request, Circonscription $circonscription)
    {
        $circonscription->update($request->validated());

        $request->session()->flash('circonscription.id', $circonscription->id);

        return redirect()->route('circonscription.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Circonscription $circonscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Circonscription $circonscription)
    {
        $circonscription->delete();

        return redirect()->route('circonscription.index');
    }
}
