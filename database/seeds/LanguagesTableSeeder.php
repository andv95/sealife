<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        DB::table("languages")->insert([
            ['language_key' => 'en', 'native_name' => 'English', 'order_no' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['language_key' => 'vi', 'native_name' => 'Tiếng Việt', 'order_no' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['language_key' => 'fr', 'native_name' => 'français', 'order_no' => 2, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
