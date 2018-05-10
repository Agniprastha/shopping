<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ad9d05fe327dProductProductTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('product_product_tag')) {
            Schema::create('product_product_tag', function (Blueprint $table) {
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', 'fk_p_147160_147159_produc_5ad9d05fe33f2')->references('id')->on('products')->onDelete('cascade');
                $table->integer('product_tag_id')->unsigned()->nullable();
                $table->foreign('product_tag_id', 'fk_p_147159_147160_produc_5ad9d05fe34d0')->references('id')->on('product_tags')->onDelete('cascade');
                
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
        Schema::dropIfExists('product_product_tag');
    }
}
