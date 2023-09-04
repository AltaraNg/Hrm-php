<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasColumn('roles', 'deleted_at')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
        \App\Models\Role::query()->update(['guard_name' => 'sanctum']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (Schema::hasColumn('roles', 'deleted_at')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }

    }
};
