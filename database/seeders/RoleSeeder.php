<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Role::create([
            'name' => 'admin'
        ]);
        \App\Models\Role::create([
            'name' => 'user'
        ]);
        \App\Models\Role::create([
            'name' => 'rescue_organization'
        ]);
    }
}
