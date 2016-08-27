<?php

namespace Platformoncloud\Theme;

use Config;
use Illuminate\Support\Manager;
use InvalidArgumentException;

class ThemeManager extends Manager implements Contracts\Factory
{
    /**
     * Get a driver instance.
     *
     * @param string $driver
     *
     * @return mixed
     */
    public function with($driver)
    {
        return $this->driver($driver);
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Platformoncloud\Theme\Providers\AbstractProvider
     */
    protected function createFileDriver()
    {
        return $this->buildProvider(
            'Platformoncloud\Theme\Providers\FileProvider'
        );
    }

    /**
     * Build a theme provider instance.
     *
     * @param string $provider
     *
     * @return \Platformoncloud\Theme\Providers\AbstractProvider
     */
    public function buildProvider($provider)
    {
        return new $provider();
    }

    /**
     * Get the default driver name.
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    public function getDefaultDriver($driver = 'themes.driver')
    {
        if (Config::has($driver)) {
            return Config::get($driver);
        }

        throw new InvalidArgumentException('No Theme driver was specified.');
    }
}
