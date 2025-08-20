<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request; // Requestクラスをインポート
use Illuminate\Database\Eloquent\SoftDeletes; // SoftDeletesトレイトをインポート


class Task extends Model
{
    use HasFactory, SoftDeletes;

    // savePostメソッドで個別にプロパティを設定するため、$fillableは必須ではありませんが、
    // create()など他のLaravelの機能を使う場合に備えて残しておくと良いでしょう。
    protected $fillable = ['title', 'content', 'deadline_at','support_at','priority','status'];

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
        $this->deadline_at = !empty($request->input('deadline_at')) ? $request->input('deadline_at') : null;
        $this->support_at = !empty($request->input('support_at')) ? $request->input('support_at') : null;
        $this->priority = !empty($request->input('priority')) ? $request->input('priority') : null;
        $this->status = !empty($request->input('status')) ? $request->input('status') : null;
        // 登録処理
        $this->save();
    }
}
