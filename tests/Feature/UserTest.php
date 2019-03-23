<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;

class UserTest extends TestCase
{
    function test_can_register(){

        $faker = Factory::create();
        $username = $faker->userName;

        $this->post('/api/register',[
            'name' => $faker->name,
            'username' => $username,
            'email' => $faker->safeEmail,
            'password' => bcrypt('test'),
            'token' => md5($username),
        ])
            ->assertJson([
                'message' => 'Usuario registrado correctamente.'
            ])
            ->assertStatus(201);
    }

    function test_can_login(){
        $this->post('api/login', [
            'username' => 'ofaaoficial',
            'password' => 'ofaaoficial'
        ])
            ->assertJson([
                'message' => 'Ingreso satisfactorio.'
            ])
            ->assertStatus(200);
    }

    function test_can_logout(){
        $this->get('api/logout',['Authorization' => "Bearer 14c4b06b824ec593239362517f538b29"])
            ->assertJson([
                "message" => "Cierre de sesion satisfactorio."
            ])
            ->assertStatus(200);
    }
}
