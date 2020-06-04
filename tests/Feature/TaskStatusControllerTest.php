<?php

namespace Tests\Feature;

use App\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $taskStatus = factory(TaskStatus::class)->create();
        $response = $this->get(route('task_statuses.edit', [$taskStatus]));
        $response->assertOk();
    }

    public function testStore()
    {
        $factoryData = factory(TaskStatus::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testUpdate()
    {
        $taskStatus = factory(TaskStatus::class)->create();
        $factoryData = factory(TaskStatus::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->patch(route('task_statuses.update', $taskStatus), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $taskStatus = factory(TaskStatus::class)->create();
        $response = $this->delete(route('task_statuses.destroy', [$taskStatus]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
    }
}
