<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventixTranslationCreateDatabaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $migrations = config('translation.database.structure') ?? false;
        if ($migrations !== false)
            foreach($migrations as $table => $definition)
                Schema::create($table, $definition);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $migrations = config('translation.database.structure') ?? false;
        if ($migrations !== false)
            foreach($migrations as $table => $definition)
                Schema::dropIfExists($table);
    }
}
