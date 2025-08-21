<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DBファサードを使うために追記
use Illuminate\Support\Carbon; // 日時を入れるためによく使います

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB :: table('tasks') ->insert(
            [
                'title' =>'シーダーで作ったタスク',
                'content' => 'この内容を追加しました',
                'deadline_at' => Carbon::now()->addDays(7), // 1週間後の日時を設定
                'support_at' => Carbon::now(), // 現在の日時を設定
                'priority' => '中', // 優先度を設定
                'status' => '却下', // ステータスを設定
            ]
    );
        DB::table('tasks')->where('id', 1)->update([
        'title' => 'タイトル修正',
        'updated_at' => now(),
        ]);
    }
    
}
