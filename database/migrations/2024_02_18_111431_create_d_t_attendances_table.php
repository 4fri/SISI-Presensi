<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('d_t_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->dateTime('check_in');
            // $table->dateTime('check_out');
            $table->enum('status', ['Hadir', 'Tidak Hadir']);
            $table->string('note', 100)->nullable();
            $table->timestamps();

            $table->foreign('employee_id')
                ->references('id')
                ->on('d_t_employees')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_t_attendances');
    }
};
