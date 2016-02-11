<?php

use Illuminate\Database\Schema\Blueprint;

return [

    /*
    |--------------------------------------------------------------------------
    | Translator Sourcess
    |--------------------------------------------------------------------------
    |
    | This option specifies what sources to use, later sources will override
    | data stored by earlier sources. Note, they should implement the
    | LoaderInterface, otherwise they are ignored.
    |
    | Default: []
    |
    */

    'sources' => [
        Eventix\Translation\Sources\FileLoader::class,
        Eventix\Translation\Sources\DatabaseLoader::class,
    ],

    /*
     |--------------------------------------------------------------------------
     | Database Source Options
     |--------------------------------------------------------------------------
     |
     | Specify all options related to the database source, this mainly entails
     | specifying how the table should look and the query that will be used to
     | retrieve the translation lines.
     |
     */
    'database' => [
        'structure' => [
            'translation' => function(Blueprint $table){
                $table->guid();
                $table->guid('user_id');
                $table->string('namespace');
                $table->string('name');
                $table->string('value');

                $table->foreign('user_id')->references('guid')->on('users')->onDelete('cascade');
            }
        ],

        'lines' => function ($db){
            return $db->select('*')
                ->from('user_translations');
        },
    ]



];
