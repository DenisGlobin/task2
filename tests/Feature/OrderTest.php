<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Order;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class OrderTest extends TestCase
{
    public function testNewOrderFactory()
    {
        // Create a single App\Order instance...
        $order = factory(Order::class)->create();
        //Was the user created?
        $this->assertDatabaseHas('orders', [
            'id' => $order->id
        ]);
    }

    public function testNewOrderForm()
    {
        // Create a single App\User instance...
        $user = factory(User::class)->create();
        //Was the user created?
        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);
        //try sing in by created user, using login form
        $response = $this->json('POST', '/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);
        $this->assertAuthenticated($guard = null);

        Storage::fake('local');
        $file = UploadedFile::fake()->image('avatar.jpg');

        // use the factory to create a Faker\Factory instance
        $faker = Faker::create();

        $response = $this->json('POST', '/', [
            'userId' => $user->id,
            'title' => $faker->title,
            'message' => $faker->paragraph,
            'file' => $file,
        ])->assertSuccessful();

        // Assert the file was stored...
        Storage::disk('local')->exists($file->hashName());
    }
}
