<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'content' => $this->faker->paragraph,
            'approval_status' => Blog::APPROVAL_APPROVED,
            'hidden' => false
        ];
    }

    /**
     * Sets the Blog's approval status to 'pending'.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pending(): Factory
    {
        return $this->state([
            'approval_status' => Blog::APPROVAL_PENDING,
        ]);
    }

    /**
     * Sets the Blog's visibility to 'hidden'.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function hidden(): Factory
    {
        return $this->state([
            'hidden' => true,
        ]);
    }
}
