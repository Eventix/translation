<?php

namespace Eventix\Translation;

use Illuminate\Filesystem\Filesystem;

class AllLoader implements LoaderInterface
{
    /**
     *
     * @var array|String
     */
    protected $classSources = [];

    /**
     * All instances of Interface implementations loading
     *
     * @var array|LoaderInterface
     */
    protected $sources = [];

    /**
     * Create a new file loader instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem $files
     * @param  string $path
     */
    public function __construct(Filesystem $files, $path) {
        $this->classSources = config('translation.sources') ?? [];

        foreach ($this->classSources as $class)
            if (in_array('Eventix\Translation\LoaderInterface', class_implements($class)))
                $this->sources[] = new $class($files, $path);
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

        return array_reduce($this->sources, function ($carry, $item) use ($locale, $group, $namespace) {
            return array_merge($carry, $item->load($locale, $group, $namespace));
        }, []);
    }

    /**
     * Add a new namespace to the loader.
     *
     * @param  string $namespace
     * @param  string $hint
     * @return void
     */
    public function addNamespace($namespace, $hint) {
        foreach ($this->sources as $source)
            $source->addNamespace($namespace, $hint);
    }
}
