<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('category_id');
            $table->string('name');
            $table->string('product_code')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('price', 18, 2)->default(0);
            $table->decimal('commission',18, 2)->default(0)->comment('hoa hong');
            $table->text('note')->nullable();
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('items');
    }
}
