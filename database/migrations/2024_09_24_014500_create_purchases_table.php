<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id("purchaseId");
            $table->unsignedBigInteger('materialId');
            $table->unsignedBigInteger('supplierId');
            $table->unsignedBigInteger('statusId');
            $table->string("code");
            $table->integer("quantity");
            $table->integer("price");
            $table->integer("total");
            $table->timestamps();
            $table->foreign('materialId')->references('materialId')->on('materials')->ondelete('cascade');
            $table->foreign('supplierId')->references('supplierId')->on('suppliers')->ondelete('cascade');
            $table->foreign('statusId')->references('statusId')->on('statuses')->ondelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
