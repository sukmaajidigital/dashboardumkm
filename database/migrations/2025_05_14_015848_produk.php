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
        Schema::create('produk_kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->string('slug')->unique()->nullable();
            $table->timestamps();
        });
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->integer('harga');
            $table->integer('stock')->default(0);
            $table->string('sku')->unique()->nullable();
            $table->string('image')->nullable();

            // Lik Marketplace
            $table->string('shopee')->nullable()->comment('Link Shopee');
            $table->string('tokped')->nullable()->comment('Link Tokopedia');
            $table->string('tiktokshop')->nullable()->comment('Link Tiktok Shop');

            // SEO Fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->timestamps();
        });
        Schema::create('produk_listkategoris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_kategori_id');
            $table->foreign('produk_kategori_id')->references('id')->on('produk_kategoris')->onDelete('cascade');
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['produk_kategori_id', 'produk_id']); // Hindari duplikasi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_kategoris');
        Schema::dropIfExists('produks');
        Schema::dropIfExists('produk_listkategoris');
    }
};
