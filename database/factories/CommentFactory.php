<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
<<<<<<< Updated upstream
            'user_id' => $this->faker->numberBetween(1, 5),
            'post_id' => $this->faker->numberBetween(1,50)
=======
            'user_id' => User::where('role', '=', 'author')->get()->random()->id,
            'post_id' => Post::all()->random()->id,
            'created_at' => $this->faker->dateTimeBetween()
>>>>>>> Stashed changes
        ];
    }
}
