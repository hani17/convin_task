<?php

namespace App\Jobs;

use App\Models\Statistics;
use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefreshStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $taskCounts = Task::where('assigned_to_id', $this->user->getKey())->count();
        Statistics::updateOrCreate(['user_id' => $this->user->id], [
            'user_id' => $this->user->id,
            'tasks_count' => $taskCounts
        ]);
    }
}
