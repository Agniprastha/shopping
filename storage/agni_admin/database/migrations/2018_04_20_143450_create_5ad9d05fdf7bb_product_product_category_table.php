<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ad9d05fdf7bbProductProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('product_product_category')) {
            Schema::create('product_product_category', function (Blueprint $table) {
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', 'fk_p_147160_147158_produc_5ad9d05fdf99c')->references('id')->on('products')->onDelete('cascade');
                $table->integer('product_category_id')->unsigned()->nullable();
                $table->foreign('product_category_id', 'fk_p_147158_147160_produc_5ad9d05fdfac4')->references('id')->on('product_categories')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_product_category');
    }
}
