<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->realText($this->faker->numberBetween(10, 255)),
            'user_id' => $this->faker->numberBetween(1, 5),
            'post_id' => $this->faker->numberBetween(1,50),
            'created_at' => $this->faker->dateTimeBetween()
        ];
    }
}
