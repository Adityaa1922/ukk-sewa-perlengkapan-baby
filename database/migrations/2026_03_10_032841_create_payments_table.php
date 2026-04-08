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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();               // kode unik e.g. RENT-20250001
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_days');               // dihitung otomatis
            $table->decimal('total_price', 12, 2);
            $table->decimal('deposit', 10, 2)->default(0); // uang jaminan
            $table->text('delivery_address');
            $table->enum('status', [
                'pending',      // menunggu konfirmasi
                'confirmed',    // dikonfirmasi petugas
                'delivered',    // sudah diantar
                'active',       // sedang disewa
                'returned',     // sudah dikembalikan
                'cancelled',    // dibatalkan
            ])->default('pending');
            $table->text('notes')->nullable();              // catatan user
            $table->text('admin_notes')->nullable();        // catatan petugas
            $table->foreignId('handled_by')->nullable()     // petugas yang menangani
                  ->references('id')->on('users')
                  ->nullOnDelete();
            $table->timestamps();
        });
         Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->enum('method', ['transfer', 'cash', 'qris'])->default('transfer');
            $table->enum('status', ['unpaid', 'paid', 'refunded'])->default('unpaid');
            $table->string('proof_image')->nullable();      // bukti transfer
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('rentals');
    }
};
