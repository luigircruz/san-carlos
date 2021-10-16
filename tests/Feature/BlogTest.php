<?php

use App\Models\Blog;

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

    $response = $this->get('/api/blogs')->dump();

    $response->assertOk()
        ->assertJsonCount(3, 'data');
});