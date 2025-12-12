<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Seeder;

class UsersAndTasksSeeder extends Seeder
{
    public function run()
    {
        // 5 usuarios con 10 tareas cada uno
        User::factory()
            ->count(5)
            ->create()
            ->each(function (User $user) {
                Task::factory()
                    ->count(10)
                    ->create([
                        'user_id' => $user->id,
                    ]);
            });

        // Un usuario sin tareas para probar el LEFT JOIN de la consulta.sql
        User::factory()->create([
            'nombre' => 'Usuario sin tareas',
            'email'  => 'no-tasks@example.com',
        ]);
    }
}

