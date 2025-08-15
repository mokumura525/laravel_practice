<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DBファサードを使うために追記
use Illuminate\Support\Carbon; // 日時を入れるためによく使います


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        // // この行を追加して、シーダー実行前にpostsテーブルの全データをクリア
        DB::table('posts')->truncate();

        // posts テーブルにデータを一つ入れる例 (DBファサードを使用)
        DB::table('posts')->insert(
		        [
		            'title' => 'シーダーで作ったタイトル',
		            'body' => 'この内容を変更しました',
		            'published_at' => Carbon::now(), // 今の日時を入れる
		            'created_at' => Carbon::now(),
		            'updated_at' => Carbon::now(),
		        ]
                
		        // ,...
        );
        DB::table('posts')->where('id', 1)->update([
        'title' => 'タイトル修正',
        'updated_at' => now(),
        ]);
  



        // もっとたくさんのダミーデータを入れたいときは「ファクトリ」という機能を使うと便利です（後述）
        // \App\Models\Post::factory()->count(10)->create(); // ダミー記事を10個作る例
    }
}