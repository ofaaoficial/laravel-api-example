<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function can_register(){
        $data = [
            'name' => 'test',
            'username' => 'test',
            'email' => 'test@test.test',
            'password' => bcrypt('test'),
            'token' => md5('test'),
        ];

        $this->post('/api/register',$data)
//            ->assertJson($data)
            ->assertStatus(201);

    }
}
