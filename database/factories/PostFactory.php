<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Rubric;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(5, true),
            'description' => $this->faker->words(20, true),
            'body' => $this->faker->paragraphs(6, true),
            'image' => 'post_image.jpg',
            'rubric_id' => Rubric::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
