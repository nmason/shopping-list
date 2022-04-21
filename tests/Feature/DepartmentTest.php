<?php

use App\Models\Department;
use App\Models\Item;
use App\Models\User;
use Inertia\Testing\Assert;
use Inertia\Testing\AssertableInertia;

test('has departments index', function () {

    $this->actingAs($user = User::factory()->create());

    $response = $this->get(route('departments.index'));

    $response->assertStatus(200);
});

test('has departments only show users departments', function () {

    Department::factory(5)->create();
    $user = User::factory()->create();



    Department::factory(3)->for($user)->create();

    $this->assertCount( 8,  Department::all() );

    $this->actingAs($user);

    $response = $this->getJson(route('departments.index'));
    $response->assertStatus(200);

    $this->assertCount( 3,  $response->json('departments') );

    $response->assertStatus(200);
});

test('A department can be created and includes a user_id and slug', function () {

    $this->actingAs($user = User::factory()->create());

    $input = [
        "name" => 'test this  name'
    ];

    $response = $this->post(route('departments.store'), $input);

    $response->assertRedirect(route('departments.index'));

    $this->assertDatabaseHas( 'departments', [
        'user_id' => $user->id,
        'name' => 'test this  name',
        'slug' => 'test-this-name'
    ] );
});

test('The department show page contains the associated items', function () {

    $this->actingAs($user = User::factory()->create());

    $department = Department::factory()->for($user)->create();
    $items = Item::factory(10)->for($user)->for($department)->create();

    $response = $this->getJson(route('departments.show', $department));
    $this->assertEquals( 10, count(  $response->json("items") ) );

});

