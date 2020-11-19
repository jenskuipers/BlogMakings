<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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
            'title' => $this->faker->sentence(5, true),
            'content' => $this->faker->realText($this->faker->numberBetween(200, 500)),
            'user_id' => User::where('role', '=', 'author')->get()->random()->id,
            'category_id' => Category::all()->random()->id,
            'created_at' => $this->faker->dateTimeBetween()
        ];
    }
}
