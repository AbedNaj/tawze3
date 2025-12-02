<?php

use App\Models\Tenants\Customer;
use App\Models\Tenants\Sale;
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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sale::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Customer::class)->nullable()->constrained()->nullOnDelete();
            $table->decimal('debt_amount', 10, 2)->nullable()->default(0);
            $table->decimal('paid_amount', 10, 2)->nullable()->default(0);
            $table->decimal('remaining_amount', 10, 2)->nullable()->default(0);
            $table->enum('status', ['paid', 'unpaid', 'partially_paid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
