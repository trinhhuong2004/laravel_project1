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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\ProductVariant::class)->constrained();
            $table->foreignIdFor(\App\Models\Order::class)->constrained();

            // Sao lưu thông tin sản phẩm và biến thể sản phẩm
            $table->string('product_name');
            $table->string('product_sku');
            $table->string('product_img_thumb');
            $table->decimal('product_price_variant', 10, 2);
            $table->decimal('product_price_sale_variant', 10, 2)->nullable();
            $table->string('variant_size_name')->nullable(); // Đảm bảo cột này có tồn tại
            $table->string('variant_color_name')->nullable(); // Đảm bảo cột này có tồn tại
            $table->integer('quantity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
