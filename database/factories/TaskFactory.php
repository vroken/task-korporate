<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->sentence(mt_rand(2,6)),
            'status' => $this->faker->randomElement(['Aktif', 'Tidak Aktif']),
            'deskripsi' => collect($this->faker->paragraphs(mt_rand(1,10)))
            ->map(fn($p) => "<p>$p</p>")
            ->implode(''),
            'user_id' => mt_rand(1,5),
        ];
    }
}
