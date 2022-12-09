<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Jobs\RefreshStatistics;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    Use RefreshDatabase;

    public function getTaskData(): array
    {
        return [
            'title' => 'the test title',
            'description' => 'the test description',
            'assigned_to_id' => User::factory()->create()->id,
            'assigned_by_id' => User::factory()->admin()->create()->id
        ];
    }

    /** @test */
    public function it_get_tasks()
    {
        Task::factory()->count(20)->create();
        $response = $this->get('/api/tasks');
        $response->assertOk();
    }

    /** @test */
    public function it_creates_a_new_task()
    {
        $taskData = $this->getTaskData();
        $response = $this->post('/api/tasks', $taskData);
        $this->assertDatabaseHas('tasks', $taskData);
        $response->assertCreated();
    }

    /** @test */
    public function it_dispatches_refresh_statistics_after_creating_new_task()
    {
        Bus::fake();
        $taskData = $this->getTaskData();
        $response = $this->post('/api/tasks', $taskData);
        $this->assertDatabaseHas('tasks', $taskData);
        $task = Task::first();
        $response->assertCreated();
        Bus::assertDispatched(RefreshStatistics::class, function (RefreshStatistics $job) use ($task) {
            return $job->user->id == $task->assignedTo->id;
        });
    }

    /** @test */
    public function it_makes_sure_assigned_to_user_is_ordinary_user_before_creating_new_task()
    {
        $taskData = [
            'title' => 'the test title',
            'description' => 'the test description',
            'assigned_to_id' => User::factory()->admin()->create()->id,
            'assigned_by_id' => User::factory()->create()->id
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/tasks', $taskData);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertDatabaseEmpty('tasks');
    }

    /** @test */
    public function it_makes_sure_assigned_by_user_is_admin_user_before_creating_new_task()
    {
        $taskData = [
            'title' => 'the test title',
            'description' => 'the test description',
            'assigned_to_id' => User::factory()->create()->id,
            'assigned_by_id' => User::factory()->create()->id
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/tasks', $taskData);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertDatabaseEmpty('tasks');
    }

}
