<?php

use App\Models\Tenants\Employee;
use App\Models\Tenants\Product;
use App\Models\Tenants\WareHouse;
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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();


            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->morphs('locationable');
            $table->integer('quantity')->default(0);
            $table->integer('min_stock_alert')->default(0);
            $table->date('last_restock_date')->nullable();
            $table->enum('status', ['normal', 'low_stock', 'out_of_stock'])->default('normal');

            $table->timestamps();

            $table->unique(['product_id', 'locationable_id', 'locationable_type'], 'unique_inventory_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
