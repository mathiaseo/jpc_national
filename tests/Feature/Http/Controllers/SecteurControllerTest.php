<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Secteur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SecteurController
 */
class SecteurControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $secteurs = Secteur::factory()->count(3)->create();

        $response = $this->get(route('secteur.index'));

        $response->assertOk();
        $response->assertViewIs('secteur.index');
        $response->assertViewHas('secteurs');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('secteur.create'));

        $response->assertOk();
        $response->assertViewIs('secteur.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SecteurController::class,
            'store',
            \App\Http\Requests\SecteurStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $city = $this->faker->city;
        $nb_localite = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('secteur.store'), [
            'name' => $name,
            'city' => $city,
            'nb_localite' => $nb_localite,
        ]);

        $secteurs = Secteur::query()
            ->where('name', $name)
            ->where('city', $city)
            ->where('nb_localite', $nb_localite)
            ->get();
        $this->assertCount(1, $secteurs);
        $secteur = $secteurs->first();

        $response->assertRedirect(route('secteur.index'));
        $response->assertSessionHas('secteur.id', $secteur->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $secteur = Secteur::factory()->create();

        $response = $this->get(route('secteur.show', $secteur));

        $response->assertOk();
        $response->assertViewIs('secteur.show');
        $response->assertViewHas('secteur');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $secteur = Secteur::factory()->create();

        $response = $this->get(route('secteur.edit', $secteur));

        $response->assertOk();
        $response->assertViewIs('secteur.edit');
        $response->assertViewHas('secteur');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SecteurController::class,
            'update',
            \App\Http\Requests\SecteurUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $secteur = Secteur::factory()->create();
        $name = $this->faker->name;
        $city = $this->faker->city;
        $nb_localite = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('secteur.update', $secteur), [
            'name' => $name,
            'city' => $city,
            'nb_localite' => $nb_localite,
        ]);

        $secteur->refresh();

        $response->assertRedirect(route('secteur.index'));
        $response->assertSessionHas('secteur.id', $secteur->id);

        $this->assertEquals($name, $secteur->name);
        $this->assertEquals($city, $secteur->city);
        $this->assertEquals($nb_localite, $secteur->nb_localite);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $secteur = Secteur::factory()->create();

        $response = $this->delete(route('secteur.destroy', $secteur));

        $response->assertRedirect(route('secteur.index'));

        $this->assertDeleted($secteur);
    }
}
