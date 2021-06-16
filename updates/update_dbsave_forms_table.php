<?php namespace Dmrch\Contact\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateDbsaveFormsTable extends Migration
{
    public function up()
    {
        Schema::table('dmrch_contact_forms', function ($table) {            
            $table->binary('save_on_db');
        });
    }

    public function down()
    {
        Schema::table('dmrch_contact_forms', function ($table) {
            $table->dropColumn('save_on_db');
        });
    }
}
