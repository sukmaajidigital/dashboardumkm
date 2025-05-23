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
        // SUMBER TRANSAKSI
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->string('sumber_transaksi')->comment('whatsapp, pameran, galeri, online');
            $table->timestamps();
        });
        // PENJUALAN
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('source_id')->nullable();
            $table->foreign('source_id')->references('id')->on('sources');
            $table->date('tanggal');
            $table->string('invoicenumber');
            $table->integer('total_harga');
            $table->integer('diskon')->default(0);
            $table->integer('last_total');
            $table->string('status')->comment('belum lunas, lunas');
            $table->timestamps();
        });
        Schema::create('penjualan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualan_id')->nullable();
            $table->foreign('penjualan_id')->references('id')->on('penjualans')->onDelete('cascade');
            $table->unsignedBigInteger('produk_id')->nullable();
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('sub_harga');
            $table->timestamps();
        });
        // PEMESANAN
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('source_id')->nullable();
            $table->foreign('source_id')->references('id')->on('sources');
            $table->date('tanggal');
            $table->string('invoicenumber');
            $table->integer('total_harga');
            $table->integer('diskon')->default(0);
            $table->integer('last_total');
            $table->string('status')->comment('belum lunas, lunas');
            $table->timestamps();
        });
        Schema::create('pemesanan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id')->nullable();
            $table->foreign('pemesanan_id')->references('id')->on('pemesanans')->onDelete('cascade');
            $table->unsignedBigInteger('produk_id')->nullable();
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('sub_harga');
            $table->timestamps();
        });
        // MANUAL INVOICE
        Schema::create('manual_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('source_id')->nullable();
            $table->foreign('source_id')->references('id')->on('sources');
            $table->date('tanggal');
            $table->string('invoicenumber');
            $table->integer('total_harga');
            $table->integer('diskon')->default(0);
            $table->integer('last_total');
            $table->string('status')->comment('belum lunas, lunas');
            $table->timestamps();
        });
        Schema::create('manual_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manual_invoice_id')->nullable();
            $table->foreign('manual_invoice_id')->references('id')->on('manual_invoices')->onDelete('cascade');
            $table->string('nama_produk');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('sub_harga');
            $table->timestamps();
        });
        // DOWN PAYMENT
        Schema::create('down_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualan_id')->nullable();
            $table->foreign('penjualan_id')->references('id')->on('penjualans')->onDelete('cascade');
            $table->unsignedBigInteger('pemesanan_id')->nullable();
            $table->foreign('pemesanan_id')->references('id')->on('pemesanans')->onDelete('cascade');
            $table->unsignedBigInteger('manual_invoice_id')->nullable();
            $table->foreign('manual_invoice_id')->references('id')->on('manual_invoices')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('nominal');
            $table->timestamps();
        });
        Schema::create('invoice_setting', function (Blueprint $table) {
            $table->id();
            // main
            $table->string('logo_invoice')->nullable();
            $table->string('name_invoice')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('instagram')->nullable();
            // ttd
            $table->string('ttd_image')->nullable();
            $table->string('ttd_name')->nullable();
            $table->string('ttd_position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
        Schema::dropIfExists('penjualan_details');
        Schema::dropIfExists('pemesanans');
        Schema::dropIfExists('pemesanan_details');
        Schema::dropIfExists('manual_invoices');
        Schema::dropIfExists('manual_invoice_details');
        Schema::dropIfExists('down_payments');
        Schema::dropIfExists('invoice_setting');
    }
};
