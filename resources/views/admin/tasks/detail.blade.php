<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            タスク詳細（ID: {{ $task->id }}）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-4">
                        <h3 class="text-lg font-bold mb-4">{{ $task->title }}</h3>
                        <strong>内容:</strong>
                        <p class="mt-2 whitespace-pre-line">{{ $task->content}}</p>
                        <p class="mt-2"><strong>担当者:</strong> {{ $task->user_id_label ? : '未設定' }}</p>
                        <p class="mb-2"><strong>優先度:</strong> {{ $task->priority_label }}</p>
                        <p class="mb-2"><strong>ステータス:</strong> {{ $task->status_label }}</p>
                        <p class="mb-2"><strong>公開日時:</strong> {{ $task->support_at ? (new \Carbon\Carbon($task->support_at))->format('Y-m-d H:i:s') : '未定' }}</p>
                        <p class="mb-2"><strong>対応期限:</strong> {{ $task->deadline_at ? (new \Carbon\Carbon($task->deadline_at))->format('Y-m-d H:i:s') : '未定' }}</p>
                        <p class="mb-2"><strong>最終更新日時:</strong> {{ $task->updated_at ? (new \Carbon\Carbon($task->updated_at))->format('Y-m-d H:i:s') : '未更新' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>