<?php

namespace Eventix\Translation;

interface LoaderInterface
{
    /**
     * Load the messages for the given locale.
     *
     * @param  string  $locale
     * @param  string  $group
     * @param  string  $namespace
     * @param  mixed   $differential
     * @return array
     */
    public function load($locale, $group, $namespace = null, $differential = false);

    /**
     * Add a new namespace to the loader.
     *
     * @param  string  $namespace
     * @param  string  $hint
     * @return void
     */
    public function addNamespace($namespace, $hint);
}
