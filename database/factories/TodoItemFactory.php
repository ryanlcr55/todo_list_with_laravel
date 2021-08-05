<?php

namespace Database\Factories;

use App\Models\Todo;
use App\Models\TodoItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TodoItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'todo_id' => Todo::query()->first()->id,
            'content' => $this->faker->sentence(5, true),
            'done_at' => null,
        ];
    }
}
