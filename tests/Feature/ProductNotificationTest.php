<?php

use App\Models\User;
use App\Models\Product;
use App\Notifications\NewProductNotification;
use Illuminate\Support\Facades\Notification;

test('authenticated user can create a product and others are notified', function () {
    // Arrange
    Notification::fake();
    $user = User::factory()->create();
    $userToNotify = User::factory()->create();

    // Act
    $response = $this->actingAs($user)
        ->post(route('products.store'), [
            'name' => 'New Awesome Product',
            'description' => 'This is a great product',
            'price' => 99.99,
        ]);

    // Assert
    $response->assertRedirect();
    $this->assertDatabaseHas('products', [
        'name' => 'New Awesome Product',
        'price' => 99.99,
        'user_id' => $user->id,
    ]);

    Notification::assertSentTo(
        [$userToNotify],
        NewProductNotification::class
    );
});

test('guest cannot create a product', function () {
    $response = $this->post(route('products.store'), [
        'name' => 'Unauthorized Product',
        'price' => 10.00,
    ]);

    $response->assertRedirect('/login');
});

test('notifications page shows notifications', function () {
    $user = User::factory()->create();
    $product = Product::factory()->for($user)->create(['name' => 'Test Product']);
    
    $user->notify(new NewProductNotification($product));

    $response = $this->actingAs($user)->get(route('notifications.index'));

    $response->assertStatus(200);
    $response->assertSee('New product created: Test Product');
});
