<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('address', 100);
            $table->foreignId('trucker_id')->constrained('truckers')->onDelete('cascade');
            $table->foreignId('package_status_id')->constrained('package_statuses');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('packages');
    }
};