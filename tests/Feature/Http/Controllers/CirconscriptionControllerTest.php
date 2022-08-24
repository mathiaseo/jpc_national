<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Circonscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CirconscriptionController
 */
class CirconscriptionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $circonscriptions = Circonscription::factory()->count(3)->create();

        $response = $this->get(route('circonscription.index'));

        $response->assertOk();
        $response->assertViewIs('circonscription.index');
        $response->assertViewHas('circonscriptions');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('circonscription.create'));

        $response->assertOk();
        $response->assertViewIs('circonscription.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CirconscriptionController::class,
            'store',
            \App\Http\Requests\CirconscriptionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $city = $this->faker->city;
        $nb_secteur = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('circonscription.store'), [
            'name' => $name,
            'city' => $city,
            'nb_secteur' => $nb_secteur,
        ]);

        $circonscriptions = Circonscription::query()
            ->where('name', $name)
            ->where('city', $city)
            ->where('nb_secteur', $nb_secteur)
            ->get();
        $this->assertCount(1, $circonscriptions);
        $circonscription = $circonscriptions->first();

        $response->assertRedirect(route('circonscription.index'));
        $response->assertSessionHas('circonscription.id', $circonscription->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $circonscription = Circonscription::factory()->create();

        $response = $this->get(route('circonscription.show', $circonscription));

        $response->assertOk();
        $response->assertViewIs('circonscription.show');
        $response->assertViewHas('circonscription');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $circonscription = Circonscription::factory()->create();

        $response = $this->get(route('circonscription.edit', $circonscription));

        $response->assertOk();
        $response->assertViewIs('circonscription.edit');
        $response->assertViewHas('circonscription');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CirconscriptionController::class,
            'update',
            \App\Http\Requests\CirconscriptionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $circonscription = Circonscription::factory()->create();
        $name = $this->faker->name;
        $city = $this->faker->city;
        $nb_secteur = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('circonscription.update', $circonscription), [
            'name' => $name,
            'city' => $city,
            'nb_secteur' => $nb_secteur,
        ]);

        $circonscription->refresh();

        $response->assertRedirect(route('circonscription.index'));
        $response->assertSessionHas('circonscription.id', $circonscription->id);

        $this->assertEquals($name, $circonscription->name);
        $this->assertEquals($city, $circonscription->city);
        $this->assertEquals($nb_secteur, $circonscription->nb_secteur);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $circonscription = Circonscription::factory()->create();

        $response = $this->delete(route('circonscription.destroy', $circonscription));

        $response->assertRedirect(route('circonscription.index'));

        $this->assertDeleted($circonscription);
    }
}
