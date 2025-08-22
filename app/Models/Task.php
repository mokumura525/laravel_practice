<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request; // Requestクラスをインポート
use Illuminate\Database\Eloquent\SoftDeletes; // SoftDeletesトレイトをインポート


class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'content', 'deadline_at','support_at','priority','status'];

/**
 * タスクの優先度を取得するアクセサ
 *
 * @return string
 */

public function getPriorityLabelAttribute()
{
    $labels = config('const.task.priority');
    return $labels[$this->priority] ?? '未設定';
}

/**
 * タスクのステータスを取得するアクセサ
 *
 * @return string
 */

public function getStatusLabelAttribute()
{
    $labels = config('const.task.status');
    return $labels[$this->status] ?? '未設定';
}

public function getUserIdLabelAttribute()

{
    $user = User::find($this->user_id);
    return $user ? $user->name : '未設定';
}




    /**
     * 投稿データをモデルに設定し、保存するカスタムメソッド
     *
     * @param \Illuminate\Http\Request $request 送信されたリクエストオブジェクト
     * @return void
     */
    public function saveTask(Request $request)
    {
        // $request オブジェクトから直接データを取得し、モデルのプロパティに割り当てる
        $this->title = $request->input('title');
        $this->content = $request->input('content');
        
        // support_at は nullable なので、空文字列の場合には null を設定
        $this->user_id = $request->input('user_id');
        $this->deadline_at = !empty($request->input('deadline_at')) ? $request->input('deadline_at') : null;
        $this->support_at = !empty($request->input('support_at')) ? $request->input('support_at') : null;
        $this->priority = !empty($request->input('priority')) ? $request->input('priority') : null;
        $this->status = !empty($request->input('status')) ? $request->input('status') : null;
        // 登録処理
        $this->save();
    }
}
