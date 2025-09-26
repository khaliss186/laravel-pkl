<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Ubah price dari decimal menjadi integer (menyimpan dalam Rupiah)
            $table->integer('price')->change();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->integer('price')->change();
            $table->integer('total')->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->integer('total_amount')->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->change();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->change();
            $table->decimal('total', 8, 2)->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total_amount', 8, 2)->change();
        });
    }
};