<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Init extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	   Schema::connection('migrations')->create('housing.items', function ($table) {
            $table->increments("id");
            $table->integer("distance");
            $table->integer("floor");
            $table->integer("age");
            $table->integer("layout");
            $table->integer("school");
            $table->integer("air");
            $table->integer("light");
            $table->string("name", 100);
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
		 Schema::connection('migrations')->dropIfExists('housing.items');
	}

}
