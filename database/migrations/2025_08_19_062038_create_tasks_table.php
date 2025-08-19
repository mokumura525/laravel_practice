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
           
            $table->unsignedTinyInteger('status')->default(1);   // 起票
            $table->unsignedTinyInteger('priority')->default(3); // 中dateTime('support_at')->nullable(); // 必須
     
            $table->dateTime('sucreated_at')->nullable(); // 必須
            $table->dateTime('updated_at')->nullable(); // 必須
            $table->dateTime('deleted_at')->nullable(); // 必須
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
