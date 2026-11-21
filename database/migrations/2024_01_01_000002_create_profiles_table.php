<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();      // contoh: Web Developer
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('cv')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('profiles'); }
};
