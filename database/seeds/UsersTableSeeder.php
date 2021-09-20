<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            "name" => "Administrator",
            "email" => "admin@admin.com",
            "password" => bcrypt("1234"),
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}
