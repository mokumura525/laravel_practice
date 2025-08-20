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
                                <th class="border px-4 py-2">タイトル</th>
                                <th class="border px-4 py-2">対応期限</th>
                                <th class="border px-4 py-2">優先度</th>
                                <th class="border px-4 py-2">ステータス</th>
                                <th class="border px-4 py-2">最終更新日時</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="border px-4 py-2">{{ $task->id }}</td>
                                    <td class="border px-4 py-2">{{ $task->title }}</td>
                                    <td class="border px-4 py-2">{{ $task->deadline_at ? (new \Carbon\Carbon($task->deadline_at))->format('Y-m-d H:i:s') : '未定' }}</td>
                                    <td class="border px-4 py-2">{{ $task->priority }}</td>
                                    <td class="border px-4 py-2">{{ $task->status }}</td>
                                    <td class="border px-4 py-2">{{ $task->updated_at ? (new \Carbon\Carbon($task->updated_at))->format('Y-m-d H:i:s') : '未更新' }}</td>
                                </tr>
                            @endforeach
</x-app-layout>
