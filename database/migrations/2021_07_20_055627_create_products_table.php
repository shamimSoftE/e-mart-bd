<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('sub_category_id')->nullable();
            $table->bigInteger('section_id')->nullable();
            $table->float('regular_price');
            $table->float('special_price');
            $table->string('quantity');
            $table->string('size')->nullable();
            $table->string('color_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->text('long_description');
            $table->text('short_description')->nullable();
            $table->mediumText('return_policy')->nullable();
            $table->string('tag_title')->nullable();
            $table->string('p_tag')->nullable();
            $table->integer('delivery')->nullable();
            $table->string('omq')->nullable();
            $table->text('image')->nullable();
            $table->text('video')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
