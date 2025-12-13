<?php

use App\Models\Tenants\Customer;
use App\Models\Tenants\Employee;
use App\Models\Tenants\PaymentMethod;
use App\Models\Tenants\User;
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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('sourceable');
            $table->foreignIdFor(Customer::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(User::class, 'created_by')->nullable()->constrained()->nullOnDelete();
            $table->string('invoice_number');
            $table->decimal('price', 10, 2)->default(0);
            $table->enum('status', ['draft', 'confirmed', 'cancelled'])->default('draft');
            $table->text('note')->nullable();
            $table->decimal('total_paid', 10, 2)->default(0);
            $table->enum('payment_status', ['paid', 'unpaid', 'partially_paid'])->default('paid');
            $table->date('invoice_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
