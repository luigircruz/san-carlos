<?php

use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;

it('lists all blogs with pagination', function () {
    Blog::factory(50)->create();

    $response = $this->get('/api/blogs');

    $response->assertOk()
        ->assertJsonCount(20, 'data')
        ->assertJsonStructure(['data', 'meta', 'links'])
        ->assertJsonStructure(['data' => ['*' => ['id', 'title']]]);
});

it('only lists blogs that are not hidden and is approved', function () {
    Blog::factory(3)->create();

    Blog::factory()->hidden()->create();
    Blog::factory()->pending()->create();

    $response = $this->get('/api/blogs');

    $response->assertOk()
        ->assertJsonCount(3, 'data');
});

it('includes images tags and user', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    Blog::factory(3)->for($user)->hasTags(1)->hasImages(1)->create();

    $response = $this->get('/api/blogs')->dump();

    $response->assertOk();
});