<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDraftItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('order_draft_items');

        Schema::create('order_draft_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_draft_id');
            $table->unsignedInteger('product_id');
            $table->foreign('order_draft_id')->references('id')->on('order_drafts');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_draft_items');
    }
}
