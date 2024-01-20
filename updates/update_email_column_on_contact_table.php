<?php namespace Dmrch\Contact\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateEmailColumnOnContactTable extends Migration
{
    public function up()
    {
        Schema::table('dmrch_contact_contacts', function ($table) {      
            $table->string('email', 255)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('dmrch_contact_contacts', function ($table) {  
            $table->string('email', 255)->change();
        });
    }
}
