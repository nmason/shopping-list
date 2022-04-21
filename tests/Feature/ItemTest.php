<?php

use App\Models\Department;
use App\Models\Item;
use App\Models\User;
use Inertia\Testing\Assert;
use Inertia\Testing\AssertableInertia;

test('has items index', function () {

    $this->actingAs($user = User::factory()->create());

    $response = $this->get(route('items.index'));

    $response->assertStatus(200);
});

test('items only show users items and are grouped by deparment', function () {

    $user1 = User::factory()->create();
    Item::factory(5)->for(Department::factory()->for($user1)->create())->for($user1)->create();
    $user = User::factory()->create();



    Item::factory(3)->for( Department::factory()->create() )->for($user)->create();
    Item::factory(3)->for( Department::factory()->create() )->for($user)->create();

    $this->assertCount( 11,  Item::all() );

    $this->actingAs($user);

    $response = $this->getJson(route('items.index'));
    $response->assertStatus(200);

    $this->assertCount( 2,  $response->json('items') );

    $response->assertStatus(200);
});

test('A item can be created', function () {

    $this->actingAs($user = User::factory()->create());


    $input = [
        "name" => 'test this  name',
        "department_id" => Department::factory()->for($user)->create()->id
    ];


    $response = $this->post(route('items.store'), $input);

    $response->assertRedirect(route('items.index'));

    $this->assertDatabaseHas( 'items', [
        'user_id' => $user->id,
        'name' => 'test this  name',
    ] );
});
