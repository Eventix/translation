<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CommonMark Extenstions
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

];
