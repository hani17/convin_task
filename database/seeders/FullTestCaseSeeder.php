<?php

namespace Database\Seeders;

use App\Models\Statistics;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FullTestCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->count(50)->create();
        $admins = User::factory()->admin()->count(50)->create();

        $users->each(function (User $user) use ($admins) {
            $tasks = Task::factory()->count(random_int(1, 50))->create([
                'assigned_to_id' => $user->id,
                'assigned_by_id' => $admins->random(1)->first()->id,
            ]);
            Statistics::factory()->create([
                'user_id' => $user->id,
                'tasks_count' => $tasks->count()
            ]);
        });
    }
}
