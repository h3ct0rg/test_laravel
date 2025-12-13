<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $estados = ['pendiente', 'en_progreso', 'completada'];

        return [
            'titulo'      => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph,
            'estado'      => $this->faker->randomElement($estados),
            'user_id'     => User::factory(),
        ];
    }
}
