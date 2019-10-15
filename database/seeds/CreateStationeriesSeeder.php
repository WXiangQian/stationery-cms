<?php

use Illuminate\Database\Seeder;

class CreateStationeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['碳素笔1根', '碳素笔2根', '笔记本1个', '书架子1个', '记号笔1根', '记号笔2根'];

        foreach ($names as $key => $name) {
            DB::table('stationeries')->insert([
                'user_id' => rand(1,10),
                'name' => $name,
                'url' => 'https://wxiangqian.github.io',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);
        }
    }
}
