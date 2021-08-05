<?php

namespace Database\Factories;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $files = collect(array_fill(0, random_int(1, 4), 'a'))
            ->map(fn () => sprintf('files/%s.%s', $this->faker->uuid(), $this->faker->fileExtension()));

        return [
            'user_id' => User::query()->first()->id,
            'title' => $this->faker->realTextBetween(1, 30),
            'attachment' => $files->toArray(),
        ];
    }
}
