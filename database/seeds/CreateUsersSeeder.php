<?php

use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x=1; $x<=10; $x++) {
            DB::table('users')->insert([
                'name' => str_random(10),
                'd_id' => rand(1,7),
                'sex' => rand(1,2),
                'mobile' => "178".rand(11111111,99999999),
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);
        }
    }
}
