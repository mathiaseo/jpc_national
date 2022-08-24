<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Localite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LocaliteController
 */
class LocaliteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $localites = Localite::factory()->count(3)->create();

        $response = $this->get(route('localite.index'));

        $response->assertOk();
        $response->assertViewIs('localite.index');
        $response->assertViewHas('localites');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('localite.create'));

        $response->assertOk();
        $response->assertViewIs('localite.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LocaliteController::class,
            'store',
            \App\Http\Requests\LocaliteStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $city = $this->faker->city;

        $response = $this->post(route('localite.store'), [
            'name' => $name,
            'city' => $city,
        ]);

        $localites = Localite::query()
            ->where('name', $name)
            ->where('city', $city)
            ->get();
        $this->assertCount(1, $localites);
        $localite = $localites->first();

        $response->assertRedirect(route('localite.index'));
        $response->assertSessionHas('localite.id', $localite->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $localite = Localite::factory()->create();

        $response = $this->get(route('localite.show', $localite));

        $response->assertOk();
        $response->assertViewIs('localite.show');
        $response->assertViewHas('localite');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $localite = Localite::factory()->create();

        $response = $this->get(route('localite.edit', $localite));

        $response->assertOk();
        $response->assertViewIs('localite.edit');
        $response->assertViewHas('localite');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LocaliteController::class,
            'update',
            \App\Http\Requests\LocaliteUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $localite = Localite::factory()->create();
        $name = $this->faker->name;
        $city = $this->faker->city;

        $response = $this->put(route('localite.update', $localite), [
            'name' => $name,
            'city' => $city,
        ]);

        $localite->refresh();

        $response->assertRedirect(route('localite.index'));
        $response->assertSessionHas('localite.id', $localite->id);

        $this->assertEquals($name, $localite->name);
        $this->assertEquals($city, $localite->city);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $localite = Localite::factory()->create();

        $response = $this->delete(route('localite.destroy', $localite));

        $response->assertRedirect(route('localite.index'));

        $this->assertDeleted($localite);
    }
}
