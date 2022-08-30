<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Jeune;
use App\Models\Localite;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\JeuneController
 */
class JeuneControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $jeunes = Jeune::factory()->count(3)->create();

        $response = $this->get(route('jeune.index'));

        $response->assertOk();
        $response->assertViewIs('jeune.index');
        $response->assertViewHas('jeunes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('jeune.create'));

        $response->assertOk();
        $response->assertViewIs('jeune.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JeuneController::class,
            'store',
            \App\Http\Requests\JeuneStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $firstname = $this->faker->firstName;
        $lastname = $this->faker->lastName;
        $city = $this->faker->city;
        $fonction = $this->faker->randomElement(/** enum_attributes **/);
        $is_married = $this->faker->boolean;
        $is_water_baptism = $this->faker->boolean;
        $is_spirit_baptism = $this->faker->boolean;
        $birthday = $this->faker->date();
        $date_water_baptism = $this->faker->date();
        $date_spirit_baptism = $this->faker->date();
        $sexe = $this->faker->randomElement(/** enum_attributes **/);
        $localite = Localite::factory()->create();

        $response = $this->post(route('jeune.store'), [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'city' => $city,
            'fonction' => $fonction,
            'is_married' => $is_married,
            'is_water_baptism' => $is_water_baptism,
            'is_spirit_baptism' => $is_spirit_baptism,
            'birthday' => $birthday,
            'date_water_baptism' => $date_water_baptism,
            'date_spirit_baptism' => $date_spirit_baptism,
            'sexe' => $sexe,
            'localite_id' => $localite->id,
        ]);

        $jeunes = Jeune::query()
            ->where('firstname', $firstname)
            ->where('lastname', $lastname)
            ->where('city', $city)
            ->where('fonction', $fonction)
            ->where('is_married', $is_married)
            ->where('is_water_baptism', $is_water_baptism)
            ->where('is_spirit_baptism', $is_spirit_baptism)
            ->where('birthday', $birthday)
            ->where('date_water_baptism', $date_water_baptism)
            ->where('date_spirit_baptism', $date_spirit_baptism)
            ->where('sexe', $sexe)
            ->where('localite_id', $localite->id)
            ->get();
        $this->assertCount(1, $jeunes);
        $jeune = $jeunes->first();

        $response->assertRedirect(route('jeune.index'));
        $response->assertSessionHas('jeune.id', $jeune->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $jeune = Jeune::factory()->create();

        $response = $this->get(route('jeune.show', $jeune));

        $response->assertOk();
        $response->assertViewIs('jeune.show');
        $response->assertViewHas('jeune');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $jeune = Jeune::factory()->create();

        $response = $this->get(route('jeune.edit', $jeune));

        $response->assertOk();
        $response->assertViewIs('jeune.edit');
        $response->assertViewHas('jeune');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JeuneController::class,
            'update',
            \App\Http\Requests\JeuneUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $jeune = Jeune::factory()->create();
        $firstname = $this->faker->firstName;
        $lastname = $this->faker->lastName;
        $city = $this->faker->city;
        $fonction = $this->faker->randomElement(/** enum_attributes **/);
        $is_married = $this->faker->boolean;
        $is_water_baptism = $this->faker->boolean;
        $is_spirit_baptism = $this->faker->boolean;
        $birthday = $this->faker->date();
        $date_water_baptism = $this->faker->date();
        $date_spirit_baptism = $this->faker->date();
        $sexe = $this->faker->randomElement(/** enum_attributes **/);
        $localite = Localite::factory()->create();

        $response = $this->put(route('jeune.update', $jeune), [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'city' => $city,
            'fonction' => $fonction,
            'is_married' => $is_married,
            'is_water_baptism' => $is_water_baptism,
            'is_spirit_baptism' => $is_spirit_baptism,
            'birthday' => $birthday,
            'date_water_baptism' => $date_water_baptism,
            'date_spirit_baptism' => $date_spirit_baptism,
            'sexe' => $sexe,
            'localite_id' => $localite->id,
        ]);

        $jeune->refresh();

        $response->assertRedirect(route('jeune.index'));
        $response->assertSessionHas('jeune.id', $jeune->id);

        $this->assertEquals($firstname, $jeune->firstname);
        $this->assertEquals($lastname, $jeune->lastname);
        $this->assertEquals($city, $jeune->city);
        $this->assertEquals($fonction, $jeune->fonction);
        $this->assertEquals($is_married, $jeune->is_married);
        $this->assertEquals($is_water_baptism, $jeune->is_water_baptism);
        $this->assertEquals($is_spirit_baptism, $jeune->is_spirit_baptism);
        $this->assertEquals(Carbon::parse($birthday), $jeune->birthday);
        $this->assertEquals(Carbon::parse($date_water_baptism), $jeune->date_water_baptism);
        $this->assertEquals(Carbon::parse($date_spirit_baptism), $jeune->date_spirit_baptism);
        $this->assertEquals($sexe, $jeune->sexe);
        $this->assertEquals($localite->id, $jeune->localite_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $jeune = Jeune::factory()->create();

        $response = $this->delete(route('jeune.destroy', $jeune));

        $response->assertRedirect(route('jeune.index'));

        $this->assertDeleted($jeune);
    }
}
