<?php

use App\Models\Tenants\Employee;
use App\Models\Tenants\Inventory;
use App\Models\Tenants\Product;
use App\Models\Tenants\Sale;
use App\Models\User;
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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Employee::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Sale::class)->nullable()->constrained()->nullOnDelete();
            $table->integer('quantity');
            $table->decimal('cost', 8, 2)->nullable()->default(0);
            $table->enum('type', [
                'purchase_in',
                'sale_out',
                'return_in',
                'adjustment_in',
                'adjustment_out',
                'transfer_out',
                'transfer_in',
                'reserved',
                'reserved_release',
                'correction',
            ]);
            $table->foreignIdFor(User::class, 'created_by')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Employee::class, 'target_employee_id')
                ->nullable()
                ->constrained('employees')
                ->nullOnDelete();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
