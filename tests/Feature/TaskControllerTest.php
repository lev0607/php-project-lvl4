<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;
use App\User;

class TaskControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $task = factory(Task::class)->create();
        $response = $this->get(route('tasks.edit', [$task]));
        $response->assertOk();
    }

    public function testStore()
    {
        $user = factory(User::class)->create();
        $factoryData = factory(Task::class)->make()->toArray();

        $data = \Arr::only($factoryData, ['name', 'status_id', 'assigned_to_id', 'description']);
        $response = $this->actingAs($user)->post(route('tasks.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();

        $factoryData = factory(Task::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name', 'status_id', 'assigned_to_id', 'description']);
        $response = $this->actingAs($user)->patch(route('tasks.update', $task), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDestroy()
    {
        $task = factory(Task::class)->create();
        $response = $this->delete(route('tasks.destroy', [$task]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
