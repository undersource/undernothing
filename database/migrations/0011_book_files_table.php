<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('book_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->string('name')->nullable(false)->unique();
        });
    }

    public function down() {
        Schema::dropIfExists('book_files');
    }
};
