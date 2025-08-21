<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            タスク一覧
        </h2>
    </x-slot>
    
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- 成功メッセージの表示 --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            新規作成
                        </a>
                    </div>

                    <table class="table-auto w-full border">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">担当者</th>
                                <th class="border px-4 py-2">タイトル</th>
                                <th class="border px-4 py-2">対応期限</th>
                                <th class="border px-4 py-2">優先度</th>
                                <th class="border px-4 py-2">ステータス</th>
                                <th class="border px-4 py-2">最終更新日時</th>
                                <th class="border px-4 py-2">操作</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($task as $val)
                                <tr>
                                    <td class="border px-4 py-2">{{ $val->id }}</td>
                                    <td class="border px-4 py-2">{{ $val->user_id }}</td>
                                    <td class="border px-4 py-2">{{ $val->title }}</td>
                                    <td class="border px-4 py-2">{{ $val->deadline_at ? (new \Carbon\Carbon($val->deadline_at))->format('Y-m-d H:i:s') : '未定' }}</td>
                                    <td class="border px-4 py-2">{{ $val->priority }}</td>
                                    <td class="border px-4 py-2">{{ $val->status }}</td>
                                    <td class="border px-4 py-2">{{ $val->updated_at ? (new \Carbon\Carbon($val->updated_at))->format('Y-m-d H:i:s') : '未更新' }}</td>
                                      <td class="border px-4 py-2 flex items-center justify-center space-x-2"> {{-- ここを flex に変更 --}}
                                        <a href="{{ route('admin.tasks.detail', $val->id) }}" class="text-blue-600 hover:underline">詳細</a>
                                        <a href="{{ route('admin.tasks.edit', $val->id) }}" class="ml-2 text-green-600 hover:underline">編集</a>
                                        <form action="{{ route('admin.tasks.delete', $val->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline bg-transparent border-none cursor-pointer p-0 m-0">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
</x-app-layout>
