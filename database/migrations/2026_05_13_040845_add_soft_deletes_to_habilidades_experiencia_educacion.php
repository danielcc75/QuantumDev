<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = ['habilidades', 'experiencia_laboral', 'formacion_academica'];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->softDeletes();
                $t->unsignedBigInteger('deleted_by')->nullable()->after('deleted_at');
                $t->text('delete_reason')->nullable()->after('deleted_by');
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->dropSoftDeletes();
                $t->dropColumn(['deleted_by', 'delete_reason']);
            });
        }
    }
};
