<?php namespace Dmrch\Contact\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateEmailColumnOnContactTable extends Migration
{
    public function up()
    {
        Schema::create('dmrch_contact_contacts', function(Blueprint $table) {
            $table->string('email', 255)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::create('dmrch_contact_contacts', function(Blueprint $table) {
            $table->string('email', 255)->change();
        });
    }
}
