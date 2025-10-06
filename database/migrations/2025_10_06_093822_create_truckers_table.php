<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('truckers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('document', 10)->unique();
            $table->string('first_name', 45);
            $table->string('last_name', 45);
            $table->date('birth_date');
            $table->string('license_number', 10);
            $table->string('phone', 20);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('truckers');
    }
};
