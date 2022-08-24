<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ImageGallery;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PostController
 */
class PostControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $posts = Post::factory()->count(3)->create();

        $response = $this->get(route('post.index'));

        $response->assertOk();
        $response->assertViewIs('post.index');
        $response->assertViewHas('posts');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('post.create'));

        $response->assertOk();
        $response->assertViewIs('post.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PostController::class,
            'store',
            \App\Http\Requests\PostStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $title = $this->faker->sentence(4);
        $content = $this->faker->paragraphs(3, true);
        $image_gallery = ImageGallery::factory()->create();
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $views = $this->faker->numberBetween(-10000, 10000);
        $like = $this->faker->numberBetween(-10000, 10000);
        $favorite = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('post.store'), [
            'title' => $title,
            'content' => $content,
            'image_gallery_id' => $image_gallery->id,
            'type' => $type,
            'views' => $views,
            'like' => $like,
            'favorite' => $favorite,
        ]);

        $posts = Post::query()
            ->where('title', $title)
            ->where('content', $content)
            ->where('image_gallery_id', $image_gallery->id)
            ->where('type', $type)
            ->where('views', $views)
            ->where('like', $like)
            ->where('favorite', $favorite)
            ->get();
        $this->assertCount(1, $posts);
        $post = $posts->first();

        $response->assertRedirect(route('post.index'));
        $response->assertSessionHas('post.id', $post->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post.show', $post));

        $response->assertOk();
        $response->assertViewIs('post.show');
        $response->assertViewHas('post');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post.edit', $post));

        $response->assertOk();
        $response->assertViewIs('post.edit');
        $response->assertViewHas('post');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PostController::class,
            'update',
            \App\Http\Requests\PostUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $post = Post::factory()->create();
        $title = $this->faker->sentence(4);
        $content = $this->faker->paragraphs(3, true);
        $image_gallery = ImageGallery::factory()->create();
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $views = $this->faker->numberBetween(-10000, 10000);
        $like = $this->faker->numberBetween(-10000, 10000);
        $favorite = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('post.update', $post), [
            'title' => $title,
            'content' => $content,
            'image_gallery_id' => $image_gallery->id,
            'type' => $type,
            'views' => $views,
            'like' => $like,
            'favorite' => $favorite,
        ]);

        $post->refresh();

        $response->assertRedirect(route('post.index'));
        $response->assertSessionHas('post.id', $post->id);

        $this->assertEquals($title, $post->title);
        $this->assertEquals($content, $post->content);
        $this->assertEquals($image_gallery->id, $post->image_gallery_id);
        $this->assertEquals($type, $post->type);
        $this->assertEquals($views, $post->views);
        $this->assertEquals($like, $post->like);
        $this->assertEquals($favorite, $post->favorite);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $post = Post::factory()->create();

        $response = $this->delete(route('post.destroy', $post));

        $response->assertRedirect(route('post.index'));

        $this->assertDeleted($post);
    }
}
