<?php

use App\Enums\Auctions\AuctionStatus;
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
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            $table->string('status')->default(AuctionStatus::DRAFT->value);
            $table->decimal('buyout_price', 15, 2)->nullable();
            $table->decimal('starting_price', 15, 2)->default(0);
            $table->decimal('current_price', 15, 2)->nullable();
            $table->decimal('minimum_bid_increment', 15, 2)->default(10);
            $table->string('currency', 3)->default('SAR');
            $table->unsignedInteger('bid_count')->default(0);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // index for performance
            $table->index(['status', 'start_date']);
            $table->index(['status', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
