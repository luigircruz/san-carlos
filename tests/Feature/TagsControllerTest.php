<?php

use App\Models\Tag;

it('lists all tags', function () {
    Tag::factory(3)->create();

    $response = $this->get('/api/tags');

    $response->assertOk()
        ->assertJsonCount(3, 'data');
});
