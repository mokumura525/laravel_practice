<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{
    public function index()
    {
        $task = Task::all();
        return view('admin.tasks.index', compact('task'));
    }
     public function detail($id)
    {
        // 指定IDの記事を取得。見つからなければ404エラー
        $task = Task::findOrFail($id);
        return view('admin.tasks.detail', compact('task'));
    }
    public function create()
    {
        return view('admin.tasks.create');
    }

    public function store(Request $request)
    {
        // バリデーション
        $validator = $this->validateTask($request);

        // バリデーションに失敗した場合
        if ($validator->fails()) {
            // リダイレクト先を admin.Tasks.create ルートに変更
            return redirect(route('admin.tasks.create')) 
                ->withErrors($validator) // エラーメッセージをセッションに保存
                ->withInput(); // 直前に入力されたデータをセッションに保存
        }

        // Taskモデルのカスタムメソッドを使ってデータを保存
        $Task = new Task();
        // $request オブジェクトを直接 saveTask メソッドに渡す
        $Task->saveTask($request); 

        return redirect(route('admin.tasks.index'))->with('success', 'タスクが正常に投稿されました。');
    }
    public function edit($id)
    {
        // 指定IDの記事を取得。見つからなければ404エラー
        $task = Task::findOrFail($id);
        return view('admin.tasks.create', compact('task'));
    }



    public function update(Request $request, $id)
    {
        // バリデーション (新規作成時と同じ validateTask メソッドを再利用)
        $validator = $this->validateTask($request);

        // バリデーションに失敗した場合
        if ($validator->fails()) {
            // 編集フォームのルートにリダイレクト
            return redirect(route('admin.tasks.edit', $id))
                ->withErrors($validator) // エラーメッセージをセッションに保存
                ->withInput(); // 直前に入力されたデータをセッションに保存
        }

        // 更新対象の記事を取得
        $Task = Task::findOrFail($id);

        // Taskモデルのカスタムメソッドを使ってデータを更新
        // saveTask メソッドは、既存のインスタンスに対して呼び出すことで更新処理を行う
        $Task->saveTask($request);

        // 記事一覧ページへリダイレクトし、成功メッセージを表示
        return redirect(route('admin.tasks.index'))->with('success', 'タスクが正常に更新されました。');
    }

      public function destroy($id)
    {
        // 削除対象の記事を取得。見つからなければ404エラー
        $Task = Task::findOrFail($id);

        // 論理削除を実行
        $Task->delete(); // SoftDeletesトレイトを使用していれば、deleted_atカラムが更新される

        // 記事一覧ページへリダイレクトし、成功メッセージを表示
        return redirect(route('admin.tasks.index'))->with('success', 'タスクが正常に削除されました。');
    }




    /**
     * 投稿データに対するバリデーションルールを定義し、適用する
     *content
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateTask(Request $request)
    {
        $rules = [
            'title' => 'required|max:100',
            'content' => 'required|max:1000',
            'deadline_at' => 'nullable|date_format:Y-m-d\TH:i', // HTMLのdatetime-local形式に対応
        ];

        $messages = [
            'title.required' => ':attributeは必須項目です。',
            'title.max' => ':attributeは:max文字以内で入力してください。',
            'content.required' => ':attributeは必須項目です。',
            'content.max' => ':attributeは:max文字以内で入力してください。',
            'deadline_at.date_format' => ':attributeは正しい日時形式で入力してください。',
        ];
        
        $attributes = [
            'title' => 'タイトル',
            'content' => '本文',
            'deadline_at' => '対応日時',
        ];

        

        return Validator::make($request->all(), $rules, $messages, $attributes);
    }
    
}
