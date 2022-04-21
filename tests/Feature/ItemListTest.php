<?php

use App\Models\Department;
use App\Models\Item;
use App\Models\ItemList;
use App\Models\User;
use Inertia\Testing\Assert;
use Inertia\Testing\AssertableInertia;

test('has Shopping List index', function () {

    $this->actingAs($user = User::factory()->create());

    $response = $this->get(route('list.index'));

    $response->assertStatus(200);
});



test('A Shopping List Item can be created', function () {

    $this->actingAs($user = User::factory()->create());

    $item = Item::factory()->for(Department::factory()->for($user)->create())->for($user)->create();

    $input = [
        "item_id" => $item->id,
        "quantity" => 1
    ];

    $response = $this->post(route('list.store'), $input);

    $response->assertRedirect(route('list.index'));

    $this->assertDatabaseHas( 'item_lists', [
        'user_id' => $user->id,
        'item_id' => $item->id,
        'quantity' => 1
    ] );
});

test('A Shopping List Item can be marked as purchased', function () {

    $this->actingAs($user = User::factory()->create());

    $item = Item::factory()->for(Department::factory()->for($user)->create())->for($user)->create();
    $list = ItemList::factory()->for($item)->for($user)->create();

    $input = [
        "purchased" => 1,
        "quantity" => 1
    ];

    $response = $this->put(route('list.update', $list), $input);

    $response->assertRedirect(route('list.index'));

    $this->assertDatabaseHas( 'item_lists', [
        'id' => $list->id,
        'quantity' => 1,
        'purchased' => 1
    ] );
});
