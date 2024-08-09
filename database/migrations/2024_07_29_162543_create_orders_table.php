<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use \App\Models\Order;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            // Thông tin người nhan
            $table->string('user_email');
            $table->string('user_name');
            $table->string('user_address');
            $table->string('user_phone');

            // Thông tin người nận hàng
            $table->string('receiver_email');
            $table->string('receiver_name');
            $table->string('receiver_address');
            $table->string('receiver_phone');

            $table->string('order_status')->default(Order::PENDING);
            $table->string('payment_status')->default(Order::UNPAID);

            $table->string('total_price',15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
