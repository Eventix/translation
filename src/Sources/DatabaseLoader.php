<?php

namespace Eventix\Translation\Sources;

use Eventix\Translation\LoaderInterface;

class DatabaseLoader implements LoaderInterface
{
    /**
     * All of the namespace hints.
     *
     * @var array
     */
    protected $hints = [];

    /**
     * Load the messages for the given locale.
     *
     * @param  string $locale
     * @param  string $group
     * @param  string $namespace
     * @param  string $differential
     * @return array
     */
    public function load($locale, $group, $namespace = null, $differential = false) {
        $cb = config('translation.database.lines');

        if(gettype($cb) === 'object')
            return $cb($locale, $group, $namespace, $differential);

        return [];
    }

    /**
     * Add a new namespace to the loader.
     *
     * @param  string $namespace
     * @param  string $hint
     * @return void
     */
    public function addNamespace($namespace, $hint) {
        $this->hints[$namespace] = $hint;
    }
}
