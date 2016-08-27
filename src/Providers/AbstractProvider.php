<?php

namespace Platformoncloud\Theme\Providers;

use Illuminate\Contracts\View\Factory as ViewFactory;

class AbstractProvider
{
    protected $theme;
    protected $info;
    protected $defaultDriver;
    protected $defaultPath;
    protected $defaultTheme;

    /**
     * Constructs config properties.
     *
     * @return void
     */
    private function __construct()
    {
        $this->loadConfigAsProperty();
    }

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param string $view
     * @param array  $data
     * @param array  $mergeData
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view($view = null, $data = [], $mergeData = [])
    {
        $this->addDefaultLocation($this->defaultPath, $this->defaultTheme);
        $factory = app(ViewFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data, $mergeData);
    }

    /**
     * Set the custom parameters of the request.
     *
     * @param array $parameters
     *
     * @return void
     */
    public function with(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Add more locations and namespaces.
     *
     * @param string $path
     */
    protected function addLocation($path)
    {
        view()->addLocation($path);
        view()->addNamespace('theme', $path);
    }

    /**
     * Add default theme location and namespace.
     *
     * @param string $path
     * @param string $theme
     */
    private function addDefaultLocation($path, $theme)
    {
        if (\Config::has($path) && \Config::has($theme)) {
            $this->addLocation(config($path).'/'.config($theme));
        }
    }

    /**
     * Get and setter for configurations (Set as properties).
     *
     * @return void
     */
    protected function loadConfigAsProperty()
    {
        $this->defaultDriver = config('themes.driver');
        $this->defaultPath = 'themes.connections.'.$this->defaultDriver.'.path';
        $this->defaultTheme = 'themes.connections.'.$this->defaultDriver.'.default_theme';
    }
}
