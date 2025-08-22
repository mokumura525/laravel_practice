<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

$statusList = config('const.task.status');
$priorityList = config('const.task.priority');

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');//必須
            $table->text('content');//必須
            $table->foreignId('user_id')->nullable(); // 担当者の外部キー制約
           
            $table->string('status')->default();   // 
            $table->string('priority')->default(); // 
            $table->dateTime('deadline_at')->nullable(); // 必須
            $table->dateTime('support_at')->nullable(); // 必須

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
