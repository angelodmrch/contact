<?php namespace Dmrch\Contact\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateNewslettersTable extends Migration
{
    public function up()
    {
        Schema::create('dmrch_contact_newsletters', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('email', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dmrch_contact_newsletters');
    }
}
