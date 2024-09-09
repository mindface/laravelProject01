<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('todos')->insert(
            [
              [
                'title' => 'テスト1',
                'body' => 'テスト1',
                'description' => 'テスト1',
                'created_at' => now(),
                'updated_at' => now(),
              ],
              [
                'title' => 'テスト2',
                'body' => 'テスト2',
                'description' => 'テスト2',
                'created_at' => now(),
                'updated_at' => now(),
              ],
              [
                'title' => 'テスト3',
                'body' => 'テスト3',
                'description' => 'テスト3',
                'created_at' => now(),
                'updated_at' => now(),
              ],
            ]
          );
    }
}
