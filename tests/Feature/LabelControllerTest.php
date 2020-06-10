<?php

namespace Tests\Feature;

use App\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $taskStatus = factory(Label::class)->create();
        $response = $this->get(route('labels.edit', [$taskStatus]));
        $response->assertOk();
    }

    public function testStore()
    {
        $factoryData = factory(Label::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->post(route('labels.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdate()
    {
        $taskStatus = factory(Label::class)->create();
        $factoryData = factory(Label::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->patch(route('labels.update', $taskStatus), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy()
    {
        $taskStatus = factory(Label::class)->create();
        $response = $this->delete(route('labels.destroy', [$taskStatus]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('labels', ['id' => $taskStatus->id]);
    }
}
