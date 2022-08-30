<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image_galleryStoreRequest;
use App\Http\Requests\Image_galleryUpdateRequest;
use App\ImageGallery;
use App\imageGallery;
use Illuminate\Http\Request;

class Image_galleryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $imageGalleries = ImageGallery::all();

        return view('imageGallery.index', compact('imageGalleries'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('imageGallery.create');
    }

    /**
     * @param \App\Http\Requests\Image_galleryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Image_galleryStoreRequest $request)
    {
        $imageGallery = ImageGallery::create($request->validated());

        $request->session()->flash('imageGallery.id', $imageGallery->id);

        return redirect()->route('imageGallery.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\imageGallery $imageGallery
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Image_gallery $imageGallery)
    {
        return view('imageGallery.show', compact('imageGallery'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\imageGallery $imageGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Image_gallery $imageGallery)
    {
        return view('imageGallery.edit', compact('imageGallery'));
    }

    /**
     * @param \App\Http\Requests\Image_galleryUpdateRequest $request
     * @param \App\imageGallery $imageGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Image_galleryUpdateRequest $request, Image_gallery $imageGallery)
    {
        $imageGallery->update($request->validated());

        $request->session()->flash('imageGallery.id', $imageGallery->id);

        return redirect()->route('imageGallery.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\imageGallery $imageGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Image_gallery $imageGallery)
    {
        $imageGallery->delete();

        return redirect()->route('imageGallery.index');
    }
}
