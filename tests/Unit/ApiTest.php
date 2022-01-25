<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class ApiTest extends TestCase
{

    public function test_country_data_if_user_not_logged()
    {
        $response = $this->get('/api/country-data');
        $response
            ->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Invalid token provided'
            ]);
    }

    public function test_country_data()
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('/api/country-data');
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_summary_data()
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('/api/country-data');
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_auth()
    {
        $email = User::first()?->email;
        $password = 'VeryLongPasswordForSafety';
        $response = $this->post('/api/auth/login', [
            'email' => $email,
            'password' => $password
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_auth_with_incorrect_password()
    {
        $email = User::first()?->email;
        $password = 'DefinitelyNotCorrectPassword';
        $response = $this->post('/api/auth/login', [
            'email' => $email,
            'password' => $password
        ]);
        $response
            ->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
    }

}
