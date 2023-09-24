<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('virtual_aliases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->references('id')->on('virtual_domains')->onDelete('cascade');
            $table->string('source')->unique()->nullable(false);
            $table->string('destination')->unique()->nullable(false);
        });
    }

    public function down() {
        Schema::dropIfExists('virtual_aliases');
    }
};
