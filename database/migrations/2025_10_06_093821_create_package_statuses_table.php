<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('package_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status', 45);
        });
    }
    public function down(): void {
        Schema::dropIfExists('package_statuses');
    }
};
