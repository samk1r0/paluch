<?php namespace Depcore\Tools\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateToolsTable Migration
 */
class CreateToolsTable extends Migration
{
    public function up()
    {
        Schema::create('depcore_tools_tools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('sort_order')->unsigned()->default(1);
            $table->boolean('is_published')->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('depcore_tools_tools');
    }
}
