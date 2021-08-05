<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_users()
    {
        $resp = $this->get('/api/v1/users');

        $resp->assertStatus(200)
            ->assertJson([
                'end' => true
            ])
            ->assertJsonStructure([
                'current',
                'end',
                'page_size',
                'list' => [
                    '*' => [
                        'id',
                        'username',
                        'name'
                    ]
                ]
            ]);
    }
}
