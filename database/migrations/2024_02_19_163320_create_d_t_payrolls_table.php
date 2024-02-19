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
        Schema::create('d_t_payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->integer('total_attendance')->nullable();
            $table->integer('total_not_present')->nullable();
            $table->decimal('basic_salary', 20, 2)->nullable();
            $table->decimal('cutting', 20, 2)->nullable();
            $table->decimal('total_salary', 20, 2)->nullable();
            $table->enum('status', ['Already paid', 'Not yet paid'])->default('Not yet paid')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('employee_id')
                ->references('id')
                ->on('d_t_employees')
                ->cascadeOnDelete();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_t_payrolls');
    }
};
