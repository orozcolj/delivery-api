<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('trucker_truck', function (Blueprint $table) {
            $table->foreignId('trucker_id')->constrained('truckers')->onDelete('cascade');
            $table->foreignId('truck_id')->constrained('trucks')->onDelete('cascade');
            $table->primary(['trucker_id', 'truck_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('trucker_truck');
    }
};