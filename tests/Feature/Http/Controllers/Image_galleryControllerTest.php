<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ImageGallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Image_galleryController
 */
class Image_galleryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $imageGalleries = Image_gallery::factory()->count(3)->create();

        $response = $this->get(route('image_gallery.index'));

        $response->assertOk();
        $response->assertViewIs('imageGallery.index');
        $response->assertViewHas('imageGalleries');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('image_gallery.create'));

        $response->assertOk();
        $response->assertViewIs('imageGallery.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Image_galleryController::class,
            'store',
            \App\Http\Requests\Image_galleryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('image_gallery.store'));

        $response->assertRedirect(route('imageGallery.index'));
        $response->assertSessionHas('imageGallery.id', $imageGallery->id);

        $this->assertDatabaseHas(imageGalleries, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $imageGallery = Image_gallery::factory()->create();

        $response = $this->get(route('image_gallery.show', $imageGallery));

        $response->assertOk();
        $response->assertViewIs('imageGallery.show');
        $response->assertViewHas('imageGallery');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $imageGallery = Image_gallery::factory()->create();

        $response = $this->get(route('image_gallery.edit', $imageGallery));

        $response->assertOk();
        $response->assertViewIs('imageGallery.edit');
        $response->assertViewHas('imageGallery');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Image_galleryController::class,
            'update',
            \App\Http\Requests\Image_galleryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $imageGallery = Image_gallery::factory()->create();

        $response = $this->put(route('image_gallery.update', $imageGallery));

        $imageGallery->refresh();

        $response->assertRedirect(route('imageGallery.index'));
        $response->assertSessionHas('imageGallery.id', $imageGallery->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $imageGallery = Image_gallery::factory()->create();
        $imageGallery = ImageGallery::factory()->create();

        $response = $this->delete(route('image_gallery.destroy', $imageGallery));

        $response->assertRedirect(route('imageGallery.index'));

        $this->assertDeleted($imageGallery);
    }
}
