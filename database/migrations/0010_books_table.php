<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->string('name')->nullable(false)->unique()->index();
        });
    }

    public function down() {
        Schema::dropIfExists('books');
    }
};
