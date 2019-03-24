<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentTest extends TestCase
{
    function test_active_token(){
        $this->post('api/login', [
            'username' => 'ofaaoficial',
            'password' => 'ofaaoficial'
        ])
            ->assertJson([
                'message' => 'Ingreso satisfactorio.'
            ])
            ->assertStatus(200);
    }

    function test_create(){
        $this->post('api/department', [
            'name' => Factory::create()->name,
        ], ['Authorization' => "Bearer 14c4b06b824ec593239362517f538b29"])->assertJson([
            'message' => 'Registrado correctamente.'
        ])->assertStatus(201);
    }

    function test_all(){
        $this->get('api/department',['Authorization' => "Bearer 14c4b06b824ec593239362517f538b29"])
            ->assertStatus(200);
    }

    function test_find(){
        $this->get('api/department/1', ['Authorization' => "Bearer 14c4b06b824ec593239362517f538b29"])
            ->assertJson([
                'id' => 1
            ])
            ->assertStatus(200);
    }

    function test_update(){
        $this->put('api/department/2', [
            'name' => Factory::create()->name . 'Test' ,
        ], ['Authorization' => "Bearer 14c4b06b824ec593239362517f538b29"])
            ->assertJson([
                'message' => 'Operacion realizada correctamente.'
            ])->assertStatus(200);
    }

    function test_delete(){
        $this->delete('api/department/2', [], ['Authorization' => "Bearer 14c4b06b824ec593239362517f538b29"])
            ->assertJson([
                'message' => 'Operacion realizada correctamente.'
            ])
            ->assertStatus(200);
    }
}
