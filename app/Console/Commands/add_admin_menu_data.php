<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class add_admin_menu_data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add_admin_menu_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '添加后台菜单数据';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('admin_menu')->insert([
            'parent_id' => 0,
            'order' => 8,
            'title' => '员工管理',
            'icon' => 'fa-users',
            'uri' => 'users',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
        DB::table('admin_menu')->insert([
            'parent_id' => 0,
            'order' => 9,
            'title' => '部门管理',
            'icon' => 'fa-bars',
            'uri' => 'departments',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
        DB::table('admin_menu')->insert([
            'parent_id' => 0,
            'order' => 10,
            'title' => '办公用品管理',
            'icon' => 'fa-home',
            'uri' => 'stationeries',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
        DB::table('admin_menu')->insert([
            'parent_id' => 0,
            'order' => 11,
            'title' => 'EnvManager',
            'icon' => 'fa-gears',
            'uri' => 'env-manager',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
    }
}
