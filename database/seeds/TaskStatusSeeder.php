<?php

use Illuminate\Database\Seeder;
use App\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = collect(['new', 'in work', 'in testing', 'completed']);
        $statuses->each(function ($item) {
            TaskStatus::create([
                'name' => $item,
            ]);
        });
    }
}
