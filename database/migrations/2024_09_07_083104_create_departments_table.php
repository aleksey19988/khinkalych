<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tableName = 'departments';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Наименование подразделения');
            $table->string('district')->nullable()->comment('Наименование района');
            $table->string('microdistrict')->nullable()->comment('Наименование микрорайона');
            $table->string('street')->comment('Наименование улицы');
            $table->string('house')->comment('Номер дома');
            $table->unsignedBigInteger('city_id')->comment('ID города');
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
