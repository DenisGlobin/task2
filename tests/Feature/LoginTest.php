<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    protected $user;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        // Create a single App\User instance...
        $this->user = factory(User::class)->create();
    }

    public function testIsNewUserCreated()
    {
        //Was the user created?
        $this->assertDatabaseHas('users', [
            'email' => $this->user->email
        ]);
    }

    public function testLoadLoginPage()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testLoginForm()
    {
        //try sing in by created user, using login form
        $response = $this->json('POST', '/login', [
            'email' => $this->user->email,
            'password' => 'secret'
        ]);
        $this->assertAuthenticated($guard = null);
        $response->assertRedirect('/');
    }
}
