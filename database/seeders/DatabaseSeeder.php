<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('addresses')->truncate();
        DB::table('contacts')->truncate();
        
        User::factory()
            ->count(10)
            ->hasPosts(2)
            ->create();
    }
}

/*
            ->hasAddress(1)
            ->hasContact(1)*/