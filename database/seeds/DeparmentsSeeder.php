<?php

use Illuminate\Database\Seeder;
use App\Department;

class DeparmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'Departamento 1'
        ]);
    }
}
