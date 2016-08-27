<?php

namespace Platformoncloud\Theme\Contracts;

interface Provider
{
    /**
     * Use a theme as the current theme.
     *
     * @param string $theme
     *
     * @return void
     */
    public function use($theme);

    /**
     * Check whether a theme exists or not.
     *
     * @param string $theme
     *
     * @return bool
     */
    public function exists($theme);

    /**
     * Return theme information.
     *
     * @param string $theme
     *
     * @return mixed
     */
    public function info($theme = null);
}
