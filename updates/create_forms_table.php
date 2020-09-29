<?php namespace Dmrch\Contact\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFormsTable extends Migration
{
    public function up()
    {
        Schema::create('dmrch_contact_forms', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255);
            $table->string('code', 255);
            $table->string('emails', 500)->nullable();
            $table->text('fields');
            $table->boolean('redirect')->default(false);
            $table->string('redirect_to', 255)->nullable();
            $table->text('success_message')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dmrch_contact_forms');
    }
}