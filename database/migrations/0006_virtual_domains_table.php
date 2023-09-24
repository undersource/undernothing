<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('virtual_domains', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable(false);
        });
    }

    public function down() {
        Schema::dropIfExists('virtual_domains');
    }
};
