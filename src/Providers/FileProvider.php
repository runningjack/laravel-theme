<?php

namespace Platformoncloud\Theme\Providers;

use Exception;
use Platformoncloud\Theme\Contracts\Provider;

class FileProvider extends AbstractProvider implements Provider
{
    /**
     * Constructs config properties.
     *
     * @return void
     */
    public function __construct()
    {
        $this->loadConfigAsProperty();
    }

    /**
     * Use a theme as the current theme.
     *
     * @param string $theme
     *
     * @return void
     */
    public function use($theme)
    {
        $this->theme = $theme;
        $this->addLocation(config($this->defaultPath).'/'.$theme);

        return $this;
    }

    /**
     * Check whether a theme exists or not.
     *
     * @param string $theme
     *
     * @return bool
     */
    public function exists($theme)
    {
        $path = config($this->defaultPath).'/'.$theme;

        return is_dir($path);
    }

    /**
     * Return theme information.
     *
     * @param string $theme
     *
     * @return mixed|Exception
     */
    public function info($theme = null)
    {
        if ($theme && $this->exists($theme)) {
            $this->info = json_decode(file_get_contents(config($this->defaultPath).'/'.$theme.'/theme.json'), true);
        } elseif ($this->theme && $this->exists($this->theme)) {
            $this->info = json_decode(file_get_contents(config($this->defaultPath).'/'.$this->theme.'/theme.json'), true);
        }

        if ($this->info) {
            return $this->info;
        }

        throw new \Exception("theme.json file isn't exists.");
    }
}
