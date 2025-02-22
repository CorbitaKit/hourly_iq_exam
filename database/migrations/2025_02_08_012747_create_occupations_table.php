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
        Schema::create('occupations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('job_id');
            $table->string('invoice_number');
            $table->date('date');
            $table->float('total_amount');
            $table->string('customer_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupations');
    }
};
