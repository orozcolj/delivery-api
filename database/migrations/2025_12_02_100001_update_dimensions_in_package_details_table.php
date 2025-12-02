<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('package_details', function (Blueprint $table) {
            $table->string('dimensions', 45)->change();
        });
    }
    public function down(): void {
        // No es reversible si el tipo anterior era diferente
    }
};
