<?php

use Illuminate\Database\Seeder;
use App\Admin;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //一括削除
        Admin::truncate();

        //特定のデータを追加
        Admin::create([
            'name' => 'test1',
            'email' => 'test1@test.com',
            'password' => Hash::make('testtest')
        ]);
        //
    }
}
