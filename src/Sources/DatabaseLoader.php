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

    protected $shouldNotTrigger = true;

    public function __construct(){
        $this->shouldNotTrigger = !in_array('http_authorization', array_map('strtolower', array_keys($_SERVER)));
    }

    /**
     * Load the messages for the given locale.
     *
     * @param  string $locale
     * @param  string $group
     * @param  string $namespace
     * @return array
     */
    public function load($locale, $group, $namespace = null) {
        $cb = config('translation.database.lines');

        if(gettype($cb) === 'object' && $this->shouldNotTrigger === false)
            return $cb($locale, $group, $namespace);

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
