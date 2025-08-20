<x-app-layout>
    <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($task) ? 'タスク編集（ID: ' . $task->id . '）' : '新規投稿' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">{{ isset($task) ? 'タスク編集' : '新規投稿' }}</h1>
                    {{-- バリデーションエラーメッセージの表示 --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                            <strong class="font-bold">入力内容にエラーがあります！</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- フォームの action と method を登録/更新で切り替える --}}
                    <form action="{{ isset($task) ? route('admin.tasks.update', $task->id) : route('admin.tasks.store') }}" method="POST">
                        @csrf
                        @if (isset($task))
                            @method('PUT')
                        @endif
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">タイトル：</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $task->title ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">本文：</label>
                            <textarea name="content" id="content" rows="6" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('content', $task->content ?? '') }}</textarea>
                        </div>
                        
                        <div class="mb-6">
                            <label for="deadline_at" class="block text-gray-700 text-sm font-bold mb-2">対応期限：</label>
                            <input type="datetime-local" name="deadline_at" id="deadline_at" value="{{ old('deadline_at', isset($task->deadline_at) ? \Carbon\Carbon::parse($task->deadline_at)->format('Y-m-d\TH:i') : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="mb-6">
                            <label for="support_at" class="block text-gray-700 text-sm font-bold mb-2">対応日時：</label>
                            <input type="datetime-local" name="support_at" id="support_at" value="{{ old('support_at', isset($task->support_at) ? \Carbon\Carbon::parse($task->support_at)->format('Y-m-d\TH:i') : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                      <div class="mb-6">
                            <label for="priority" class="block text-gray-700 text-sm font-bold mb-2">優先度：</label>
                            <select name="priority" id="priority" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach (config('const.task.priority') ?? [] as $priority)
                                    <option value="{{ $priority }}" {{ old('priority', $task->priority ?? '') === $priority ? 'selected' : '' }}>
                                        {{ $priority }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                         <div class="mb-6">
                            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">ステータス：</label>
                             <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach (config('const.task.status') ?? [] as $status)
                                    <option value="{{ $status }}" {{ old('status', $task->status ?? '') === $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ isset($task) ? '更新' : '投稿' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>