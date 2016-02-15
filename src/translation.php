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

    'sources'  => [
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
            'translation' => function (Blueprint $table) {
                $table->guid('company_id');
                $table->string('namespace')->nullable();
                $table->string('locale');
                $table->string('group');
                $table->string('name');
                $table->string('value');

                $table->foreign('company_id')->references('guid')->on('companies')->onDelete('cascade');
                $table->unique('company_id', 'locale', 'group', 'name');
            }
        ],

        'lines' => function ($locale, $group, $namespace = null, $differential = false) {
            $r = \DB::table('translation')
                ->where('locale', $locale)
                ->where('group', $group)
                ->where('namespace', $namespace == '*' ? null : $namespace);

            $r = ($differential === false ? $r->whereNull('company_id') : $r->where('company_id', $differential));

            return $r->pluck('value', 'name');
        },
    ]

];
