<?php

use App\Models\Blog;

it('lists all blogs with pagination', function () {
    Blog::factory(50)->create();

    $response = $this->get('/api/blogs')->dump();

    $response->assertOk()
        ->assertJsonCount(20, 'data')
        ->assertJsonStructure(['data', 'meta', 'links'])
        ->assertJsonStructure(['data' => ['*' => ['id', 'title']]]);
});